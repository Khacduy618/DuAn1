
        <h1>Add New Address</h1>
        <!-- Form thêm địa chỉ -->
        <form action="?mod=address&act=store" method="post">
            <div class="mb-3">
                <label for="user_email" class="form-label fw-bold">Email</label>
                <input type="email" id="user_email" name="user_email" class="form-control shadow-sm bg-light" value="<?= $user_email ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="address_name" class="form-label">Name</label>
                <input type="text" id="address_name" name="address_name" class="form-control" placeholder="Enter address name" required>
            </div>

            <div class="mb-3">
                <label for="address_city" class="form-label">City</label>
                <select id="address_city" name="address_city" class="form-select" required>
                    <option value="">Choose City</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address_street" class="form-label">Street</label>
                <input type="text" id="address_street" name="address_street" class="form-control" placeholder="Enter street name" required>
            </div>

            <div class="mb-3">
                <label for="address_status" class="form-label">Status</label>
                <select id="address_status" name="address_status" class="form-select" required>
                    <option value="1">Use</option>
                    <option value="0">Wait</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success px-4 py-2 shadow">Save Address</button>
                <a href="?mod=address&act=list" class="btn btn-outline-secondary px-4 py-2 shadow ms-2">Cancel</a>
            </div>
        </form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const citySelect = document.getElementById('address_city');

        fetch('https://provinces.open-api.vn/api/')
            .then(response => response.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">Choose City</option>';
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.name;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching cities:', error);
                citySelect.innerHTML = '<option value="">Error loading cities</option>';
            });
    });
</script>