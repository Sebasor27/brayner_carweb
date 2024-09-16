
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Brayner Car</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .product-card {
            margin-bottom: 20px;
        }
        .modal-body {
            max-height: 400px;
            overflow-y: auto;
        }
        .product-card .card-img-top {
          width: 100%;
          height: 200px;
          object-fit: contain; 
         
}

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Brayner<span>Car</span></a>
            <a class="navbar-brand" href="">SISTEMA<span>ENCOMIENDAS</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="cartIcon" data-bs-toggle="modal" data-bs-target="#cartModal">
                            <i class="bi bi-cart-fill bi-xl"></i> <span id="cartCount" class="badge bg-secondary">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Product 1 -->
            <div class="col-md-4">
                <div class="card product-card">
                <img src="<?php echo base_url; ?>Assets/img/cajita.png" class="card-img-top" alt="Product 1">
                <div class="card-body">
                        <h5 class="card-title">Cajas</h5>
                        <p class="card-text">$5.00</p>
                        <button class="btn btn-primary add-to-cart" data-product="1" data-price="10">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card product-card">
                <img src="<?php echo base_url; ?>Assets/img/maleta.jpg" class="card-img-top" alt="Product 1">
                <div class="card-body">
                        <h5 class="card-title">Maletas</h5>
                        <p class="card-text">$10.00</p>
                        <button class="btn btn-primary add-to-cart" data-product="2" data-price="20">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="col-md-4">
                <div class="card product-card">
                <img src="<?php echo base_url; ?>Assets/img/documento.jpg" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Docuemntos</h5>
                        <p class="card-text">$3.00</p>
                        <button class="btn btn-primary add-to-cart" data-product="3" data-price="30">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Cart -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="cartItems" class="list-group">
                        <!-- Cart items will be injected here -->
                    </ul>
                    <div class="mt-3">
                        <h5>Total: $<span id="cartTotal">0.00</span></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Pagar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Pickup and Drop-off -->
    <div class="modal fade" id="pickupDropoffModal" tabindex="-1" aria-labelledby="pickupDropoffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pickupDropoffModalLabel">Detalles de Recogida y Entrega</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="pickupDropoffForm">
                        <div class="mb-3">
                            <label for="pickupLocation" class="form-label">Lugar de Recogida</label>
                            <input type="text" class="form-control" id="pickupLocation" required>
                        </div>
                        <div class="mb-3">
                            <label for="dropoffLocation" class="form-label">Lugar de Entrega</label>
                            <input type="text" class="form-control" id="dropoffLocation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = [];
            const cartIcon = document.getElementById('cartIcon');
            const cartCount = document.getElementById('cartCount');
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            const pickupDropoffForm = document.getElementById('pickupDropoffForm');
            const pickupDropoffModal = new bootstrap.Modal(document.getElementById('pickupDropoffModal'));

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', () => {
                    const productId = button.getAttribute('data-product');
                    const productPrice = parseFloat(button.getAttribute('data-price'));

                    const item = cart.find(item => item.id === productId);

                    if (item) {
                        item.quantity++;
                        item.total += productPrice;
                    } else {
                        cart.push({ id: productId, quantity: 1, total: productPrice });
                    }

                    updateCart();

                    // Show the pickup/dropoff modal
                    pickupDropoffModal.show();
                });
            });

            function updateCart() {
                cartCount.textContent = cart.reduce((total, item) => total + item.quantity, 0);

                cartItems.innerHTML = cart.map(item => `
                    <li class="list-group-item">
                        Producto ${item.id}: $${item.total.toFixed(2)} x ${item.quantity}
                    </li>
                `).join('');

                const total = cart.reduce((sum, item) => sum + item.total, 0);
                cartTotal.textContent = total.toFixed(2);
            }

            pickupDropoffForm.addEventListener('submit', (event) => {
                event.preventDefault();
                // Handle form submission logic here if needed

                // Hide the modal after submission
                pickupDropoffModal.hide();

                // Clear form fields
                pickupDropoffForm.reset();
            });
        });
    </script>
</body>
</html>
