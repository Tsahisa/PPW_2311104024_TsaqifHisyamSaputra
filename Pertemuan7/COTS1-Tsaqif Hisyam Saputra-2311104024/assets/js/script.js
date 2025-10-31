// === 1. DATA PRODUK ===
// Hanya definisikan data ini satu kali
const productData = [
    { 
        id: 'bigmac', 
        name: 'Big Mac', 
        price: 35000, 
        desc: "Burger Ikonik McDonald's. Dua lapis daging sapi gurih disajikan dengan saus spesial, selada segar, keju, acar timun, bawang, diapit roti bertabur wijen.",
        img: ['assets/img/big_mac.png', 'assets/img/big_mac2.png'], // Array gambar
        calories: '550 kkal',
        protein: '27g'
    },
    { 
        id: 'mcspicy', 
        name: 'Mc Spicy', 
        price: 37000, 
        desc: "Burger dengan daging paha ayam goreng yang empuk, renyah dan pedas, dilengkapi dengan selada segar dan saus spesial di dalam roti berwijen.",
        img: ['assets/img/mc_spicy.png', 'assets/img/mc_spicy2.png'],
        calories: '450 kkal',
        protein: '25g'
    },
    { 
        id: 'mcflurry', 
        name: 'McFlurry Oreo', 
        price: 12000, 
        desc: "Es krim vanila lembut dengan taburan remahan Oreo yang renyah dan dingin menyegarkan.",
        img: ['assets/img/mc_flurry.png', 'assets/img/mc_flurry2.png'],
        calories: '320 kkal',
        protein: '5g'
    },
    { 
        id: 'spicychicken', 
        name: 'Spicy Chicken McDonald\'s', 
        price: 23000, 
        desc: "Ayam goreng khas McDonald's dengan bumbu pedas, rasakan sensasi pedas pada kulit yang renyah hingga daging ayam yang lembut dan gurih.",
        img: ['assets/img/spicy_chicken.png', 'assets/img/spicy_chicken2.png'],
        calories: '300 kkal',
        protein: '28g'
    },
    { 
        id: 'kentang', 
        name: 'Kentang Goreng', 
        price: 16000, 
        desc: "Kentang goreng renyah dan gurih.",
        img: ['assets/img/french_fries.png', 'assets/img/french_fries2.png'],
        calories: '350 kkal',
        protein: '4g'
    },
    { 
        id: 'cola', 
        name: 'Coca Cola', 
        price: 8000, 
        desc: "Coca cola segar dengan rasa original.",
        img: ['assets/img/coca_cola.png', 'assets/img/coca_cola2.png'],
        calories: '150 kkal',
        protein: '0g'
    },
];

// Array untuk menyimpan item di keranjang (IMPLEMENTASI JQUERY)
let cartItems = [];

// === 2. FUNGSI HELPER ===

// Fungsi untuk mendapatkan parameter dari URL (query string)
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

// Fungsi untuk memformat angka menjadi format mata uang Rupiah
function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return 'Rp ' + ribuan;
};

// === 3. FUNGSI UTAMA RENDER DETAIL PRODUK ===

function renderProductDetail(productId) {
    const product = productData.find(p => p.id === productId);

    if (!product) {
        $('#product-detail-container').html('<div class="col-12"><div class="alert alert-danger">Produk tidak ditemukan!</div></div>');
        return;
    }

    $('#page-title').text(`Detail Produk - ${product.name}`);

    // =======================================================
    // === 1. MEMBANGUN ITEM CAROUSEL DARI ARRAY product.img ===
    // =======================================================
    let carouselItemsHtml = '';
    
    // Gunakan array 'img' yang kini berisi dua path
    const images = product.img && Array.isArray(product.img) ? product.img : [product.img];

    images.forEach((imagePath, index) => {
        // Hanya elemen pertama yang mendapatkan kelas 'active'
        const isActive = index === 0 ? 'active' : '';
        
        carouselItemsHtml += `
            <div class="carousel-item ${isActive}">
                <img src="${imagePath}" class="d-block w-100 rounded-top" alt="${product.name} Gambar ${index + 1}" style="height: 400px; object-fit: cover;">
            </div>
        `;
    });
    
    // === 2. STRUKTUR HTML DETAIL PRODUK ===
    const html = `
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div id="productSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000"> 
                    <div class="carousel-inner">
                        ${carouselItemsHtml}
                    </div>
                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#productSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="p-4 border rounded-3 bg-light">
                <a href="index.html" class="btn btn-sm btn-outline-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
                <h1 class="text-danger fw-bold mb-3">${product.name}</h1>
                <h3 class="text-warning mb-4">${formatRupiah(product.price)}</h3>
                
                <h5 class="text-danger border-bottom pb-2"><i class="fas fa-info-circle"></i> Deskripsi Barang</h5>
                <p class="lead">${product.desc}</p>

                <h6 class="mt-4 text-danger">Detail Nutrisi:</h6>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item bg-light">Kalori: ${product.calories}</li>
                    <li class="list-group-item bg-light">Protein: ${product.protein}</li>
                    <li class="list-group-item bg-light">Penyajian: 1 Porsi</li>
                </ul>

                <button id="btn-add-to-cart-detail" class="btn btn-success btn-lg w-100 mt-3 add-to-cart" 
                        data-produk-id="${product.id}">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </div>
        </div>
    `;
    $('#product-detail-container').html(html);
}


// === 4. FUNGSI UTAMA KERANJANG ===

// Fungsi untuk merender Keranjang Belanja di Offcanvas
function renderCart() {
    const $cartList = $('#cart-list');
    $cartList.empty(); 
    let total = 0;

    if (cartItems.length === 0) {
        $cartList.html('<li class="list-group-item text-center text-muted">Keranjang Anda kosong.</li>');
    } else {
        cartItems.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            const cartItemHtml = `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold">${item.name}</span>
                        <br>
                        <small class="text-muted">${formatRupiah(item.price)} x ${item.quantity}</small>
                    </div>
                    <span class="badge bg-warning text-dark rounded-pill">${formatRupiah(itemTotal)}</span>
                    <button class="btn btn-sm btn-outline-danger ms-2 remove-from-cart" data-index="${index}"><i class="fas fa-trash-alt"></i></button>
                </li>
            `;
            $cartList.append(cartItemHtml);
        });
    }

    $('#cart-total').text(formatRupiah(total));
    $('#cart-count-badge').text(cartItems.length); 
}

// Fungsi untuk menambahkan item ke keranjang
function addToCart(productId) {
    const product = productData.find(p => p.id === productId);
    if (!product) {
        console.error("Produk ID tidak valid:", productId);
        return;
    }

    const existingItem = cartItems.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1; 
    } else {
        cartItems.push({ 
            id: product.id, 
            name: product.name, 
            price: product.price, 
            quantity: 1 
        });
    }
    
    $('#toast-message').text(product.name + ' berhasil ditambahkan ke keranjang!');
    const toastEl = $('#liveToast');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();

    renderCart();
    
    const $cartBadge = $('#cart-count-badge');
    $cartBadge.addClass('fa-bounce'); 
    setTimeout(function() {
        $cartBadge.removeClass('fa-bounce');
    }, 1000); 
}

// === 5. JQUERY MAIN EXECUTION ===

$(document).ready(function() {
    
    // Logika untuk detail.html: Memuat detail produk dan carousel
    if ($('#product-detail-container').length) {
        const productId = getUrlParameter('id') || 'bigmac'; 
        renderProductDetail(productId);
    }
    
    renderCart();

    // Event Handler untuk Add to Cart (berlaku di index.html dan detail.html)
    $('body').on('click', '.add-to-cart', function() {
        const productId = $(this).data('produk-id');
        addToCart(productId);
    });
    
    // Event Handler untuk Hapus Item dari Keranjang
    $('body').on('click', '.remove-from-cart', function() {
        const itemIndex = $(this).data('index');
        
        cartItems.splice(itemIndex, 1); 
        renderCart();

        const toastEl = $('#liveToast');
        $('#toast-message').text('Item berhasil dihapus dari keranjang.');
        toastEl.removeClass('bg-success').addClass('bg-danger');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
        
        setTimeout(() => toastEl.removeClass('bg-danger').addClass('bg-success'), 1000);
    });

    // Event Handler Kosongkan Keranjang
    $('#clear-cart-btn').on('click', function() {
        cartItems = [];
        renderCart();
        
        const toastEl = $('#liveToast');
        $('#toast-message').text('Keranjang belanja telah dikosongkan.');
        toastEl.removeClass('bg-success').addClass('bg-danger');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
        
        setTimeout(() => toastEl.removeClass('bg-danger').addClass('bg-success'), 1000);
    });

    // Filter Pencarian Sederhana (hanya di index.html)
    $('#input-pencarian').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        
        $('.produk-card').each(function() {
            var cardTitle = $(this).find('.card-title').text().toLowerCase();
            
            if (cardTitle.includes(searchText)) {
                $(this).parent().show(); 
            } else {
                $(this).parent().hide(); 
            }
        });
    });

    // BONUS: Implementasi jQuery untuk Fitur Komentar Sederhana (Jika ada di detail.html)
    $('#comment-form').on('submit', function(e) {
        e.preventDefault();
        const commentText = $('#comment-text').val().trim();
        
        if (commentText) {
            const username = "Tsaqif Hisyam"; 
            const time = new Date().toLocaleDateString('id-ID');

            const newComment = `
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-0 text-danger">${username} <small class="float-end text-muted">${time}</small></h6>
                        <p class="card-text">${commentText}</p>
                    </div>
                </div>
            `;
            $('#comment-list p:contains("Belum ada ulasan")').remove(); 
            $('#comment-list').prepend(newComment);
            $('#comment-text').val(''); 
            
            const toastEl = $('#liveToast');
            $('#toast-message').text('Ulasan Anda berhasil dikirim!');
            toastEl.removeClass('bg-danger').addClass('bg-success');
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });

});