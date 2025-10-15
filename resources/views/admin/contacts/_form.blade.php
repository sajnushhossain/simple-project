<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <div class="mt-1">
        <input readonly type="text" id="name" name="name" value="{{ old('name', $contact->name ?? '') }}" required
            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>
</div>

<div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <div class="mt-1">
        <input readonly type="email" id="email" name="email" value="{{ old('email', $contact->email ?? '') }}" required
            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>
</div>

<div>
    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
    <div class="mt-1">
        <input readonly type="text" id="subject" name="subject" value="{{ old('subject', $contact->subject ?? '') }}"
            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>
</div>

<div>
    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
    <div class="mt-1">
        <textarea readonly id="message" name="message" rows="5" required
            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('message', $contact->message ?? '') }}</textarea>
    </div>
</div>

<div class="flex justify-end space-x-4">
    <a href="{{ route('admin.contacts.index') }}"
        class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-300">Cancel</a>
    <!-- <button type="submit"
        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">{{ $submitButtonText ?? 'Create' }}</button> -->
</div>