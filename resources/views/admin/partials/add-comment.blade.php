<div id="addCommentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-center">
            <img src="{{ asset('assets/add-comment.jpg') }}" alt="Archive Image" class="h-40 w-40 mr-4">
        </div>
        <div class="flex justify-center mb-4">
            <h3 class="text-lg font-bold">Add Comment</h3>
        </div>
        <p class="text-gray-700 mb-4">You can add some comment of information to applicant below</p>
        <form method="POST" id="add-comment-form">
            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
            @csrf
            <input type="hidden" id="apply_id" name="apply_id" value="">
            {{-- Current comment --}}
            <label for="label" class="block mb-2">Current Comment</label>
            <p id="current-comment" class="border border-gray-300 p-2 rounded-md w-full mb-4"></p>
            <label for="add-comment" class="block mb-2">Comment</label>
            <input type="text" id="comment" name="comment" class="border border-gray-300 p-2 rounded-md w-full"
                required>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal('addCommentModal')"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="button" id="button-add-comment"
                    onclick="addComment(event, {{ isset($applicant) ? $applicant->id : 'null' }})"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Add Comment
                </button>
            </div>
        </form>
    </div>
</div>
