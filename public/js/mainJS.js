
document.getElementById('backButton').addEventListener('click', function() {
    window.history.back();
});


function changePerPage(select) {
    let perPage = select.value;
    let currentUrl = window.location.href;

    let url = new URL(currentUrl);

    url.searchParams.set('perPage', perPage);

    window.location.href = url.toString();
}

$(document).ready(function() {
    $('.user-profile-link').click(function(e) {
        e.preventDefault();
        var userName = $(this).data('name');
        window.location.href = "{{ route('profile') }}?name=" + encodeURIComponent(userName);
    });
});

$(document).ready(function() {
    $('form').submit(function(event) {
        event.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Товар успешно добавлен в корзину!');
            },
            error: function(error) {
                alert('Произошла ошибка при добавлении в корзину.');
                console.log(error);
            }
        });
    });
});

function showEditScreen() {
    document.getElementById('mainScreen').style.display = 'none';
    document.getElementById('editScreen').style.display = 'block';
}

function showMainScreen() {
    document.getElementById('mainScreen').style.display = 'block';
    document.getElementById('editScreen').style.display = 'none';
}
