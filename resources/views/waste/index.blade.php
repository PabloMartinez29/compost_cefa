@extends('layouts.masteraprendiz')

@section('content')
@vite(['resources/css/waste.css'])

<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="waste-header animate-fade-in-up">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="waste-title">
                    <i class="fas fa-recycle waste-icon"></i>
                    Waste Management
                </h1>
                <p class="waste-subtitle">
                    <i class="fas fa-user text-green-400 mr-2"></i>
                    {{ Auth::user()->name }} - Organic Waste Control System
                </p>
            </div>
            <div class="text-right">
                <div class="text-green-400 font-bold text-lg">{{ \Carbon\Carbon::now()->setTimezone('America/Bogota')->format('d/m/Y') }}</div>    
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Waste -->
        <div class="waste-card waste-card-primary animate-fade-in-up animate-delay-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Waste</div>
                    <div class="text-3xl font-bold text-gray-800">0 Kg</div>
                </div>
                <div class="waste-card-icon text-blue-300">
                    <i class="fas fa-trash"></i>
                </div>
            </div>
        </div>

        <!-- Processed Waste -->
        <div class="waste-card waste-card-success animate-fade-in-up animate-delay-2">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Processed</div>
                    <div class="text-3xl font-bold text-gray-800">0 Kg</div>
                </div>
                <div class="waste-card-icon text-green-300">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <!-- Pending Waste -->
        <div class="waste-card waste-card-warning animate-fade-in-up animate-delay-3">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending</div>
                    <div class="text-3xl font-bold text-gray-800">0 Kg</div>
                </div>
                <div class="waste-card-icon text-yellow-300">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>

        <!-- Compost Produced -->
        <div class="waste-card waste-card-info animate-fade-in-up animate-delay-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-600 uppercase tracking-wide">Compost</div>
                    <div class="text-3xl font-bold text-gray-800">0 Kg</div>
                </div>
                <div class="waste-card-icon text-cyan-300">
                    <i class="fas fa-seedling"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-1">
            <div class="waste-container animate-fade-in-up animate-delay-2">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-green-400 mr-2"></i>
                    Quick Actions
                </h2>
                <div class="space-y-3">
                    <button class="waste-btn" onclick="openModal('registerWaste')">
                        <i class="fas fa-plus mr-2"></i>
                        Register Waste
                    </button>
                    <button class="waste-btn-secondary" onclick="openModal('processWaste')">
                        <i class="fas fa-cogs mr-2"></i>
                        Process Waste
                    </button>
                    <button class="waste-btn-warning" onclick="openModal('viewReports')">
                        <i class="fas fa-chart-bar mr-2"></i>
                        View Reports
                    </button>
                    <button class="waste-btn-info" onclick="openModal('wasteHistory')">
                        <i class="fas fa-history mr-2"></i>
                        Waste History
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Waste Records -->
        <div class="lg:col-span-2">
            <div class="waste-container animate-fade-in-up animate-delay-3">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-list text-green-400 mr-2"></i>
                    Recent Waste Records
                </h2>
                
                <div class="overflow-x-auto">
                    <table class="waste-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Weight (Kg)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-4 block"></i>
                                    No waste records found
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Waste Modal -->
<div id="registerWasteModal" class="waste-modal hidden">
    <div class="waste-modal-content">
        <div class="waste-modal-header">
            <h3 class="waste-modal-title">Register New Waste</h3>
            <button class="waste-modal-close" onclick="closeModal('registerWaste')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="waste-modal-body">
            <form>
                <div class="waste-form-group">
                    <label class="waste-form-label">Waste Type</label>
                    <select class="waste-form-select">
                        <option value="">Select waste type</option>
                        <option value="organic">Organic Waste</option>
                        <option value="vegetable">Vegetable Waste</option>
                        <option value="fruit">Fruit Waste</option>
                        <option value="coffee">Coffee Grounds</option>
                    </select>
                </div>
                <div class="waste-form-group">
                    <label class="waste-form-label">Weight (Kg)</label>
                    <input type="number" class="waste-form-input" placeholder="Enter weight">
                </div>
                <div class="waste-form-group">
                    <label class="waste-form-label">Description</label>
                    <textarea class="waste-form-textarea" rows="3" placeholder="Enter description"></textarea>
                </div>
            </form>
        </div>
        <div class="waste-modal-footer">
            <button class="waste-btn-secondary" onclick="closeModal('registerWaste')">Cancel</button>
            <button class="waste-btn">Register</button>
        </div>
    </div>
</div>

<!-- Process Waste Modal -->
<div id="processWasteModal" class="waste-modal hidden">
    <div class="waste-modal-content">
        <div class="waste-modal-header">
            <h3 class="waste-modal-title">Process Waste</h3>
            <button class="waste-modal-close" onclick="closeModal('processWaste')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="waste-modal-body">
            <form>
                <div class="waste-form-group">
                    <label class="waste-form-label">Select Waste to Process</label>
                    <select class="waste-form-select">
                        <option value="">Select waste record</option>
                    </select>
                </div>
                <div class="waste-form-group">
                    <label class="waste-form-label">Processing Method</label>
                    <select class="waste-form-select">
                        <option value="">Select method</option>
                        <option value="composting">Composting</option>
                        <option value="vermicomposting">Vermicomposting</option>
                        <option value="bokashi">Bokashi</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="waste-modal-footer">
            <button class="waste-btn-secondary" onclick="closeModal('processWaste')">Cancel</button>
            <button class="waste-btn">Process</button>
        </div>
    </div>
</div>

<!-- View Reports Modal -->
<div id="viewReportsModal" class="waste-modal hidden">
    <div class="waste-modal-content">
        <div class="waste-modal-header">
            <h3 class="waste-modal-title">Waste Reports</h3>
            <button class="waste-modal-close" onclick="closeModal('viewReports')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="waste-modal-body">
            <div class="space-y-3">
                <button class="waste-btn-secondary w-full">
                    <i class="fas fa-chart-line mr-2"></i>
                    Daily Report
                </button>
                <button class="waste-btn-secondary w-full">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Weekly Report
                </button>
                <button class="waste-btn-secondary w-full">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Monthly Report
                </button>
            </div>
        </div>
        <div class="waste-modal-footer">
            <button class="waste-btn-secondary" onclick="closeModal('viewReports')">Close</button>
        </div>
    </div>
</div>

<!-- Waste History Modal -->
<div id="wasteHistoryModal" class="waste-modal hidden">
    <div class="waste-modal-content">
        <div class="waste-modal-header">
            <h3 class="waste-modal-title">Waste History</h3>
            <button class="waste-modal-close" onclick="closeModal('wasteHistory')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="waste-modal-body">
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-history text-4xl mb-4 block"></i>
                No history records found
            </div>
        </div>
        <div class="waste-modal-footer">
            <button class="waste-btn-secondary" onclick="closeModal('wasteHistory')">Close</button>
        </div>
    </div>
</div>

<script>
function openModal(modalName) {
    document.getElementById(modalName + 'Modal').classList.remove('hidden');
}

function closeModal(modalName) {
    document.getElementById(modalName + 'Modal').classList.add('hidden');
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('waste-modal')) {
        event.target.classList.add('hidden');
    }
});
</script>
@endsection
