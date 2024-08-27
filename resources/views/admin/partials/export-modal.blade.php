<div id="exportModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-center">
            <img src="{{ asset('assets/archive.jpg') }}" alt="Archive Image" class="h-40 w-40 mr-4">
        </div>
        <div class="flex justify-center mb-4">
            <h3 class="text-lg font-bold">Export Data</h3>
        </div>
        <p class="text-gray-600 mb-4">Exporting data will create a downloadable file containing all the data from the selected year. Are you sure you want to proceed?</p>
        <form action="{{ route('admin.exportSpecificAllData', ) }}" method="GET">
            @csrf
            <label for="export-year" class="block mb-2">Enter Year:</label>
            <input type="number" id="export-year" name="year" class="border border-gray-300 p-2 rounded-md w-full" required>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal('exportModal')" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Export
                </button>
            </div>
        </form>
    </div>
</div>
