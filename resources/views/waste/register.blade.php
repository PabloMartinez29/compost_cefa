@extends('layouts.masteraprendiz')

@section('content')
@vite(['resources/css/waste.css'])

<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="waste-header animate-fade-in-up">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="waste-title">
                    <i class="fas fa-plus waste-icon"></i>
                    Register Waste
                </h1>
                <p class="waste-subtitle">
                    <i class="fas fa-user text-green-400 mr-2"></i>
                    {{ Auth::user()->name }} - Register new organic waste entry
                </p>
            </div>
            <div class="text-right">
                <div class="text-green-400 font-bold text-lg">{{ \Carbon\Carbon::now()->setTimezone('America/Bogota')->format('d/m/Y') }}</div>    
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="max-w-2xl mx-auto">
        <div class="waste-form animate-fade-in-up animate-delay-1">
            <form>
                <!-- Waste Type -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Waste Type *</label>
                    <select class="waste-form-select" required>
                        <option value="">Select waste type</option>
                        <option value="organic">Organic Waste</option>
                        <option value="vegetable">Vegetable Waste</option>
                        <option value="fruit">Fruit Waste</option>
                        <option value="coffee">Coffee Grounds</option>
                        <option value="leaves">Leaves</option>
                        <option value="grass">Grass Clippings</option>
                        <option value="food">Food Scraps</option>
                    </select>
                </div>

                <!-- Weight -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Weight (Kg) *</label>
                    <input type="number" class="waste-form-input" placeholder="Enter weight in kilograms" step="0.1" min="0" required>
                </div>

                <!-- Source -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Source</label>
                    <select class="waste-form-select">
                        <option value="">Select source</option>
                        <option value="kitchen">Kitchen</option>
                        <option value="garden">Garden</option>
                        <option value="cafeteria">Cafeteria</option>
                        <option value="laboratory">Laboratory</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Collection Date -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Collection Date *</label>
                    <input type="date" class="waste-form-input" required>
                </div>

                <!-- Collection Time -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Collection Time</label>
                    <input type="time" class="waste-form-input">
                </div>

                <!-- Description -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Description</label>
                    <textarea class="waste-form-textarea" rows="4" placeholder="Enter additional details about the waste..."></textarea>
                </div>

                <!-- Quality Assessment -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Quality Assessment</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center">
                            <input type="radio" id="excellent" name="quality" value="excellent" class="mr-2">
                            <label for="excellent" class="text-sm text-gray-700">Excellent</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="good" name="quality" value="good" class="mr-2">
                            <label for="good" class="text-sm text-gray-700">Good</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="fair" name="quality" value="fair" class="mr-2">
                            <label for="fair" class="text-sm text-gray-700">Fair</label>
                        </div>
                    </div>
                </div>

                <!-- Processing Method -->
                <div class="waste-form-group">
                    <label class="waste-form-label">Recommended Processing Method</label>
                    <select class="waste-form-select">
                        <option value="">Select processing method</option>
                        <option value="composting">Traditional Composting</option>
                        <option value="vermicomposting">Vermicomposting</option>
                        <option value="bokashi">Bokashi Method</option>
                        <option value="hot_composting">Hot Composting</option>
                    </select>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" class="waste-btn-secondary" onclick="window.history.back()">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </button>
                    <button type="button" class="waste-btn-secondary">
                        <i class="fas fa-save mr-2"></i>
                        Save Draft
                    </button>
                    <button type="submit" class="waste-btn">
                        <i class="fas fa-check mr-2"></i>
                        Register Waste
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Recent Registrations -->
    <div class="max-w-4xl mx-auto mt-8">
        <div class="waste-container animate-fade-in-up animate-delay-2">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-history text-green-400 mr-2"></i>
                Recent Registrations
            </h2>
            
            <div class="overflow-x-auto">
                <table class="waste-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Weight</th>
                            <th>Source</th>
                            <th>Quality</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4 block"></i>
                                No recent registrations found
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Set today's date as default
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput) {
        dateInput.value = today;
    }
    
    const now = new Date();
    const timeString = now.toTimeString().slice(0, 5);
    const timeInput = document.querySelector('input[type="time"]');
    if (timeInput) {
        timeInput.value = timeString;
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Basic validation
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('border-red-500');
            isValid = false;
        } else {
            field.classList.remove('border-red-500');
        }
    });
    
    if (isValid) {
        // Show success message
        alert('Waste registered successfully!');
        // Here you would typically submit the form to the server
    } else {
        alert('Please fill in all required fields.');
    }
});
</script>
@endsection
