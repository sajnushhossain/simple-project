<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Advertisement;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create positions table
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 2. Create advertisement_position pivot table
        Schema::create('advertisement_position', function (Blueprint $table) {
            $table->foreignId('advertisement_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->primary(['advertisement_id', 'position_id']);
        });

        // 3. Seed positions and migrate data
        $positions = [
            ['name' => 'Top Banner', 'slug' => 'top-banner'],
            ['name' => 'Sidebar Square', 'slug' => 'sidebar-square'],
            ['name' => 'Content Middle', 'slug' => 'content-middle'],
        ];
        DB::table('positions')->insert($positions);

        $positionMap = DB::table('positions')->pluck('id', 'slug');
        $advertisements = DB::table('advertisements')->get();

        foreach ($advertisements as $advertisement) {
            if (isset($advertisement->position) && isset($positionMap[$advertisement->position])) {
                DB::table('advertisement_position')->insert([
                    'advertisement_id' => $advertisement->id,
                    'position_id' => $positionMap[$advertisement->position],
                ]);
            }
        }

        // 4. Drop old position column
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->enum('position', ['top-banner', 'sidebar-square', 'content-middle'])->after('target_url')->nullable();
        });

        // Note: This down migration does not restore the data perfectly if an ad had multiple positions.
        $relations = DB::table('advertisement_position')->get();
        $positionMap = DB::table('positions')->pluck('slug', 'id');

        foreach($relations as $relation) {
            if(isset($positionMap[$relation->position_id])) {
                DB::table('advertisements')->where('id', $relation->advertisement_id)->update(['position' => $positionMap[$relation->position_id]]);
            }
        }

        Schema::dropIfExists('advertisement_position');
        Schema::dropIfExists('positions');
    }
};