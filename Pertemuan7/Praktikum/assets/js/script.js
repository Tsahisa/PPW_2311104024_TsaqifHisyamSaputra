$(document).ready(function() {

    $('body').on('click', '.add-to-cart', function() {
        var productName = $(this).data('produk');
        
        $('#toast-message').text(productName + ' berhasil ditambahkan ke keranjang!');
        
        var toastEl = $('#liveToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    
        $('#cart-icon').addClass('fa-bounce'); 
        setTimeout(function() {
            $('#cart-icon').removeClass('fa-bounce');
        }, 1000); 
    });

    $('#btn-add-to-cart-detail').on('click', function() {
        var productName = $(this).data('produk');
        
        $('#toast-message').text(productName + ' berhasil ditambahkan ke keranjang!');
        var toastEl = $('#liveToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
        
        $('#cart-icon').addClass('fa-bounce'); 
        setTimeout(function() {
            $('#cart-icon').removeClass('fa-bounce');
        }, 1000);
    });

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

});