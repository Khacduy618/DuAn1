<div class="row">
    <div class="row frmtitle">
        <h1>Address Management</h1>
    </div>

    <!-- Display message -->
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row frmcontent">
        <form id="bulkUpdateForm" action="?mod=user&act=updateStatus" method="post">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>CITY</th>
                            <th>STREET</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listaddress)){ ?>
                        <?php foreach ($listaddress as $address): ?>
                            <tr>
                                <td><?= $address['address_id']; ?></td>
                                <td><?= $address['address_name']; ?></td>
                                <td><?= $address['address_city']; ?></td>
                                <td><?= $address['address_street']; ?></td>
                                <td class="status-cell">
                                    <?= $address['address_status'] == 1 ? 'Use' : 'Wait'; ?>
                                </td>
                                <td>
                            <form action="?mod=user&act=updateAddress" method="post">
                                <input type="hidden" name="address_id" value="<?= $address['address_id']; ?>">
                                <select name="address_status" class="form-select" onchange="this.form.submit()">
                                    <option value="1" <?= $address['address_status'] == 1 ? 'selected' : ''; ?>>Use</option>
                                    <option value="0" <?= $address['address_status'] == 0 ? 'selected' : ''; ?>>Wait</option>
                                </select>
                            </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php } else{ echo '<tr><td colspan="10">Không có địa chỉ nào.</td></tr>'; } ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="?mod=user&act=list" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Tìm tất cả các dropdown trạng thái
        const statusDropdowns = document.querySelectorAll('select[name="address_status"]');

        statusDropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', (event) => {
                const selectedOption = event.target.value; // Giá trị được chọn (1: Use, 0: Wait)
                const row = event.target.closest('tr');   // Dòng chứa dropdown này
                const statusCell = row.querySelector('.status-cell'); // Ô Status

                // Gửi yêu cầu AJAX để cập nhật trạng thái
                const formData = new FormData();
                formData.append('address_id', dropdown.closest('form').querySelector('input[name="address_id"]').value);
                formData.append('address_status', selectedOption);

                fetch('?mod=user&act=updateStatus', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật ô Status sau khi thành công
                        statusCell.textContent = selectedOption === '1' ? 'Use' : 'Wait';
                    } else {
                        alert('Failed to update address status.');
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                    alert('Failed to update address status. Please try again.');
                });
            });
        });
    });
</script>
