<x-layout>
    <div class="max-w-[1200px] mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-sm">
            <h1 class="font-serif text-4xl text-prothomalo-dark-gray mb-6">Contact Us</h1>
            <p class="text-lg text-prothomalo-muted mb-6">
                We'd love to hear from you! Whether you have a question, a news tip, or just want to provide feedback,
                feel free to reach out to us.
            </p>

            <form action="{{ route('contact.store') }}" method="POST" class="mt-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-base font-medium text-prothomalo-dark-gray">Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full h-10 rounded-md border border-prothomalo-border shadow-sm focus:border-prothomalo-blue focus:ring-prothomalo-blue text-base px-3 py-2">
                    </div>
                    <div>
                        <label for="email" class="block text-base font-medium text-prothomalo-dark-gray">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full h-10 rounded-md border border-prothomalo-border shadow-sm focus:border-prothomalo-blue focus:ring-prothomalo-blue text-base px-3 py-2">
                    </div>
                </div>
                <div class="mt-6">
                    <label for="subject" class="block text-base font-medium text-prothomalo-dark-gray">Subject</label>
                    <input type="text" name="subject" id="subject"
                        class="mt-1 block w-full h-10 rounded-md border border-prothomalo-border shadow-sm focus:border-prothomalo-blue focus:ring-prothomalo-blue text-base px-3 py-2">
                </div>
                <div class="mt-6">
                    <label for="message" class="block text-base font-medium text-prothomalo-dark-gray">Message</label>
                    <textarea name="message" id="message" rows="4"
                        class="mt-1 block w-full rounded-md border border-prothomalo-border shadow-sm focus:border-prothomalo-blue focus:ring-prothomalo-blue text-base px-3 py-2"></textarea>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-prothomalo-red hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-prothomalo-red cursor-pointer" style="background-color: #ee1414ff; !important;">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>