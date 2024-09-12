<div id="resetPassword" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-center">
            <img src="{{ asset('assets/archive.jpg') }}" alt="Archive Image" class="h-40 w-40 mr-4">
        </div>
        <div class="flex justify-center mb-4">
            <h3 class="text-lg font-bold">Reset Password</h3>
        </div>
        <p class="text-gray-600 mb-4">Reseting Password User as user requested to access their own account</p>
        <form method="POST" id="reset-password-form">
            @csrf
            @method('PATCH')
            <input type="hidden" id="user_id" name="user_id" value="">  
            <label for="reset-password" class="block mb-2">Enter Password:</label>
            <input type="password" id="reset-password" name="password" class="border border-gray-300 p-2 rounded-md w-full" required>
            <label for="confirmation-reset-password" class="block mb-2">Confirmation Password:</label>
            <input type="password" id="confirmation-reset-password" name="password_confirmation" class="border border-gray-300 p-2 rounded-md w-full" required>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal('resetPassword')" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Reset
                </button>
            </div>
        </form>
    </div>
</div>
