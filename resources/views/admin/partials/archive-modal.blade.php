<div id="archiveModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-center">
            <img src="{{ asset('assets/archive.jpg') }}" alt="Archive Image" class="h-40 w-40 mr-4">
        </div>
        <div class="flex justify-center mb-4">
            <h3 class="text-lg font-bold">Archive Data</h3>
        </div>
        <p class="text-gray-600 mb-4">Archiving data will move all the data from the selected year to the archive. This action is irreversible. Are you sure you want to proceed?</p>
        <form action="{{ route('admin.archiveYear') }}" method="POST">
            @csrf
            <label for="archive-year" class="block mb-2 font-medium">Enter Year:</label>
            <input type="number" id="archive-year" name="year" class="border border-gray-300 p-2 rounded-md w-full mb-4" required>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('archiveModal')" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Archive
                </button>
            </div>
        </form>
    </div>
</div>
