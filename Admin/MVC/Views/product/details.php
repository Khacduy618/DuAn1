<div class="product-details-container">
    <?php if (isset($data) && $data): ?>
        <div class="product-specs">
            <table class="specs-table">
                <tr>
                    <td>Operating System:</td>
                    <td><?php echo htmlspecialchars($data['os']); ?></td>
                </tr>
                <tr>
                    <td>Display & Camera:</td>
                    <td><?php echo htmlspecialchars($data['screen_cam']); ?></td>
                </tr>
                <tr>
                    <td>Graphics Card:</td>
                    <td><?php echo htmlspecialchars($data['gpu']); ?></td>
                </tr>
                <tr>
                    <td>CPU:</td>
                    <td><?php echo htmlspecialchars($data['cpu']); ?></td>
                </tr>
                <tr>
                    <td>Battery:</td>
                    <td><?php echo htmlspecialchars($data['pin']); ?></td>
                </tr>
                <tr>
                    <td>Colors:</td>
                    <td><?php echo htmlspecialchars($data['colors']); ?></td>
                </tr>
                <tr>
                    <td>Dimensions:</td>
                    <td><?php echo htmlspecialchars($data['sizes']); ?></td>
                </tr>
                <tr>
                    <td>RAM:</td>
                    <td><?php echo htmlspecialchars($data['ram']); ?></td>
                </tr>
                <tr>
                    <td>Storage:</td>
                    <td><?php echo htmlspecialchars($data['rom']); ?></td>
                </tr>
                <tr>
                    <td>Bluetooth:</td>
                    <td><?php echo htmlspecialchars($data['bluetooth']); ?></td>
                </tr>
            </table>
        </div>
    <?php else: ?>
        <div class="error-message">
            <p>Product information not found</p>
        </div>
    <?php endif; ?>
</div>

