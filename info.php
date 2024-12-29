<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Kasir</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">KasirApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#addItemModal" data-toggle="modal">Tambah Barang</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <header class="mb-4">
        <h1 class="text-center">Program Kasir</h1>
    </header>
    <form id="kasirForm" method="post">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="barcode">Scan Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Scan barcode di sini" autofocus>
            </div>
            <div class="form-group col-md-4">
                <label for="item">Nama Item</label>
                <input type="text" class="form-control" id="item" name="item" required>
            </div>
            <div class="form-group col-md-2">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group col-md-2">
                <label for="quantity">Jumlah</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group col-md-2">
                <label for="discount">Diskon (%)</label>
                <input type="number" class="form-control" id="discount" name="discount">
            </div>
            <div class="form-group col-md-2">
                <label for="tax">Pajak (%)</label>
                <input type="number" class="form-control" id="tax" name="tax">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Item</button>
    </form>
    <hr>
    <h2>Daftar Item</h2>
    <ul id="itemList" class="list-group"></ul>
    <button id="calculateTotal" class="btn btn-success mt-3">Hitung Total</button>
    <div id="totalPrice" class="mt-3"></div>

    <form id="paymentForm" class="mt-4">
        <div class="form-group">
            <label for="payment">Pembayaran</label>
            <input type="number" class="form-control" id="payment" name="payment" required>
        </div>
        <button type="button" id="calculateChange" class="btn btn-info">Hitung Kembalian</button>
        <div id="change" class="mt-3"></div>
    </form>
    <button id="printReceipt" class="btn btn-secondary mt-3">Cetak Struk</button>
</div>

<!-- Modal Tambah Barang -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Tambah Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <div class="form-group">
                        <label for="newBarcode">Barcode</label>
                        <input type="text" class="form-control" id="newBarcode" name="newBarcode" required>
                    </div>
                    <div class="form-group">
                        <label for="newName">Nama Barang</label>
                        <input type="text" class="form-control" id="newName" name="newName" required>
                    </div>
                    <div class="form-group">
                        <label for="newPrice">Harga</label>
                        <input type="number" class="form-control" id="newPrice" name="newPrice" required>
                    </div>
                    <button type="button" id="saveNewItem" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="bg-light text-center text-lg-start mt-5">
    <div class="container p-4">
        <p class="text-center">&copy; 2024 KasirApp. All rights reserved.</p>
    </div>
</footer>

<script>
    $(document).ready(function() {
        const items = [];

        // Simulasi data barang berdasarkan barcode
        let barcodeDatabase = {
            '123456': { name: 'Produk A', price: 10000 },
            '234567': { name: 'Produk B', price: 15000 },
            '345678': { name: 'Produk C', price: 20000 }
        };

        $('#barcode').on('input', function() {
            const barcode = $(this).val();
            if (barcodeDatabase[barcode]) {
                const product = barcodeDatabase[barcode];
                $('#item').val(product.name);
                $('#price').val(product.price);
            }
        });

        $('#kasirForm').on('submit', function(e) {
            e.preventDefault();
            const barcode = $('#barcode').val();
            const item = $('#item').val();
            const price = parseFloat($('#price').val());
            const quantity = parseInt($('#quantity').val());
            const discount = parseFloat($('#discount').val()) || 0;
            const tax = parseFloat($('#tax').val()) || 0;

            const totalItemPrice = price * quantity;
            const discountedPrice = totalItemPrice - (totalItemPrice * discount / 100);
            const finalPrice = discountedPrice + (discountedPrice * tax / 100);

            items.push({ barcode, item, price, quantity, discount, tax, finalPrice });

            const listItem = `<li class="list-group-item">
                ${item} - Rp ${finalPrice.toFixed(2)} (Jumlah: ${quantity}, Diskon: ${discount}%, Pajak: ${tax}%)
                <button class="btn btn-danger btn-sm float-right delete-item">Hapus</button>
            </li>`;

            $('#itemList').append(listItem);
            $('#kasirForm')[0].reset();
            $('#barcode').focus();
        });

        $(document).on('click', '.delete-item', function() {
            const index = $(this).parent().index();
            items.splice(index, 1);
            $(this).parent().remove();
        });

        $('#calculateTotal').on('click', function() {
            const total = items.reduce((sum, item) => sum + item.finalPrice, 0);
            $('#totalPrice').text(`Total Harga: Rp ${total.toFixed(2)}`);
        });

        $('#calculateChange').on('click', function() {
            const total = items.reduce((sum, item) => sum + item.finalPrice, 0);
            const payment = parseFloat($('#payment').val());

            if (payment < total) {
                $('#change').text('Uang tidak cukup!').css('color', 'red');
            } else {
                const change = payment - total;
                $('#change').text(`Kembalian: Rp ${change.toFixed(2)}`).css('color', 'green');
            }
        });

        $('#printReceipt').on('click', function() {
            let receipt = '--- Struk Belanja ---\n';
            items.forEach(item => {
                receipt += `${item.item} x${item.quantity} - Rp ${item.finalPrice.toFixed(2)}\n`;
            });
            const total = items.reduce((sum, item) => sum + item.finalPrice, 0);
            receipt += `Total: Rp ${total.toFixed(2)}\n`;
            const payment = parseFloat($('#payment').val());
            const change = payment - total;
            receipt += `Bayar: Rp ${payment.toFixed(2)}\n`;
            receipt += `Kembalian: Rp ${change.toFixed(2)}\n`;
            alert(receipt);

            // Simulasi cetak struk ke mesin kasir
            console.log('Mengirim struk ke printer...');
            console.log(receipt);
        });

        $('#saveNewItem').on('click', function() {
            const newBarcode = $('#newBarcode').val();
            const newName = $('#newName').val();
            const newPrice = parseFloat($('#newPrice').val());

            if (newBarcode && newName && newPrice) {
                barcodeDatabase[newBarcode] = { name: newName, price: newPrice };
                alert('Barang baru berhasil ditambahkan!');
                $('#addItemForm')[0].reset();
                $('#addItemModal').modal('hide');
            } else {
                alert('Harap isi semua data barang baru!');
            }
        });
    });
</script>
</body>
</html>
