<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Contact Us</h1>
            <p class="text-lg text-gray-700 mb-6">
                We'd love to hear from you! Whether you have a question, a news tip, or just want to provide feedback,
                feel free to reach out to us.
            </p>

            <form action="{{ route('contact.store') }}" method="POST" class="mt-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg">
                    </div>
                    <div>
                        <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg">
                    </div>
                </div>
                <div class="mt-6">
                    <label for="subject" class="block text-lg font-medium text-gray-700">Subject</label>
                    <input type="text" name="subject" id="subject"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg">
                </div>
                <div class="mt-6">
                    <label for="message" class="block text-lg font-medium text-gray-700">Message</label>
                    <textarea name="message" id="message" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"></textarea>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-lg font-medium rounded-md shadow-sm text-white bg-sky-300 hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>