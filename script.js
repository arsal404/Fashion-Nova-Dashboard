// Fetch Subcategories Based on Selected Category
const categorySelect = document.getElementById('category');
const subcategorySelect = document.getElementById('subcategory');

// Define Subcategories for Each Category
const subcategories = {
    1: [
        { id: '1-1', name: 'Rolex' },
        { id: '1-2', name: 'Dior' }
    ],
    2: [
        { id: '2-1', name: 'Tomi' },
        { id: '2-2', name: 'Gucci' }
    ],
    3: [
        { id: '3-1', name: 'Sveston Prime' },
        { id: '3-2', name: 'Sveston' },
        { id: '3-3', name: 'Sveston Watch' }
    ]
};

// Listen for Category Selection Changes
categorySelect.addEventListener('change', function () {
    const selectedCategory = this.value;

    // Clear Existing Subcategories
    subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

    // Add Relevant Subcategories
    if (subcategories[selectedCategory]) {
        subcategories[selectedCategory].forEach(subcategory => {
            const option = document.createElement('option');
            option.value = subcategory.id;
            option.textContent = subcategory.name;
            subcategorySelect.appendChild(option);
        });
    }
});
