$(function() {
    const API_TOKEN = 'vaGPbrXFDXLkrY9vWm79L3b9LXxBicbMEA6ZyhcdhwKpsyA3Zm1Kpb57565X';

    $("#genre-btn").on("click", function() {
        const title = $("#genre-title");
        if (title.val() == "") {
            title.focus();
            return false;
        } else if (!title.val().match(/^[a-zA-Z\s]+$/)) {
            alert("Genre must be a alphabet");
            title.focus();
            return false;
        } else {
            $.ajax({
                url: `/api/genre?api_token=${API_TOKEN}`,
                method: "POST",
                data: { title: title.val() }
            })
                .done(function(response) {
                    console.log(response);
                    if (response.status) {
                        const html = ` ${title.val()} <input type="checkbox" value="${title.val()}" class="genre"/>`;
                        $("#genre-response").append(html);
                        $("#add-genre").modal("hide");
                    }
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
    });

    $("#film-form").on("submit", function(e) {
        e.preventDefault();
        let name = $("#name").val();
        let rating = $("#rating").val();
        let desc = $("#description").val();
        let country = $("#country").val();
        let ticket_price = $("#ticket_price").val();
        let release_date = $("#release_date").val();
        let file_data = $("#photo").prop("files")[0];

        var genres = [];
        $(".genre").each(function() {
            if ($(this).is(":checked")) {
                genres.push($(this).val());
            }
        });
        genres = genres.toString();

        var form_data = new FormData();
        form_data.append("photo", file_data);
        form_data.append("name", name);
        form_data.append("description", desc);
        form_data.append("genre", genres);
        form_data.append("rating", rating);
        form_data.append("country", country);
        form_data.append("ticket_price", ticket_price);
        form_data.append("release_date", release_date);

        $.ajax({
            type: "POST",
            cache: false,
            data: form_data,
            contentType: false,
            processData: false,
            url: `/api/films?api_token=${API_TOKEN}`,
            success: function(output) {
                if (output.status) {
                    swal("Notification", "Film successfully created", "success")
                    .then(function() {
                        window.location = "/films";
                    })
                }
            }
        });
    });
});

$.fn.loadFilms = function(index) {
    const API_TOKEN = 'vaGPbrXFDXLkrY9vWm79L3b9LXxBicbMEA6ZyhcdhwKpsyA3Zm1Kpb57565X';
    $(".preview").html("Loading...");
    $.getJSON(`/api/films?api_token=${API_TOKEN}`).then(function(response) {
        if (response.status == "success" && response.result.length > 0) {
            // const previous = (index < 0) ? 0 : index;
            const total = response.result.length;
            if (index >= total - 1) {
                $("#next")
                    .parent()
                    .addClass("disabled");
            } else {
                $("#next")
                    .parent()
                    .removeClass("disabled");
            }

            if (index == 0) {
                $("#previous")
                    .parent()
                    .addClass("disabled");
            } else {
                $("#previous")
                    .parent()
                    .removeClass("disabled");
            }

            const currentIndex = index < total ? index : total - 1;
            const slug = response.result[currentIndex].slug;

            let img = `<img src="${
                response.result[currentIndex].photo
            }" alt="${
                response.result[currentIndex].photo
            }" style="width:300px;"/>`;
            html = `<a href="/films/${slug}"><h1>${
                response.result[currentIndex].name
            }</h1></a>`;
            html += `<p>${response.result[currentIndex].description.substr(0, 60)}...</p>`
            $('#image').html(img)
            $("#preview").html(html);
        }
    });
};

$.fn.loadSingleFilm = function(slug) {
    const API_TOKEN = 'vaGPbrXFDXLkrY9vWm79L3b9LXxBicbMEA6ZyhcdhwKpsyA3Zm1Kpb57565X';
    $.getJSON(`/api/films/${slug}?api_token=${API_TOKEN}`).then(function(response) {
        if (response.status == "success" && response.result != undefined) {
            $("#img")
                .attr("src", response.result.photo)
                .attr("width", "300px");
            $.fn.currency(response.result.country);
            $("#film_slug").val(response.result.slug);
            $("#title").text(response.result.name);
            $("#genre").html(`Genre: ${response.result.genre}`);
            $("#rating").html(`Rating: ${response.result.rating}`);
            $("#country").html(`Country: ${response.result.country}`);
            $("#description").html(`<p>${response.result.description}</p>`);
            $("#release_date").html(`Release Date: ${response.result.release_date}`);
            $("#ticket_price").text(response.result.ticket_price);
        } else {
            $("#preview").html("<h3>Error Occured, please try later</h3>");
        }
    });
};

$.fn.storecomment = function(data) {
    $.ajax(data)
        .done(function(response) {
            let html = '';
            if (response.status == 'success') {
                html += `<li class="list-group-item"><h5>${response.result.name}</h5>`;
                html += `<p>${response.result.comment}</p>`;
                html += `<span style="font-size: 12px;font-style:italic;">${response.result.created_at}</span></li>`;
                $('#comments-list').fadeIn('slow').prepend(html);
                $('#comment').val('')
            } else {
                html = 'Error occured';
            }
        })
        .fail(function(err) {
            console.log(err);
        });
};

$.fn.comments = function(slug) {
    const API_TOKEN = 'vaGPbrXFDXLkrY9vWm79L3b9LXxBicbMEA6ZyhcdhwKpsyA3Zm1Kpb57565X';
    $.getJSON(`/api/films/comment/${slug}?api_token=${API_TOKEN}`)
    .then(function(response) {
        let html='';
        // console.log(response)
        if (response.status == 'success' && response.result.length > 0) {
            html = `<ul class="list-group">`;
            $.each(response.result, function(index, comment) {
                html += `<li class="list-group-item"><h5>${comment.name}</h5>`;
                html += `<p>${comment.comment}</p>`;
                html += `<span style="font-size: 12px;font-style:italic;">${comment.created_at}</span></li>`;
            });
            html += `</ul>`

        } else {
            html = 'No comment available';
        }
        $('#comments-list').html(html)
    });
};


$.fn.countries = function() {
    $('#country').html('<option>please wait...</option>')
    $.getJSON('https://restcountries.eu/rest/v2/all')
    .then(function(response) {
        let li = '';
        if (response.length > 0) {
            $.each(response, function(i, val) {
                // console.log(val)
                li += `<option value="${val.name}">${val.name}</option>`;
            });
            $('#country').html(li)
        } else {
            alert("Error fetching countries")
        }
    })
    .catch(function(err) {
        console.log(err)
    })
}

$.fn.currency = function(country_name) {
    const country = country_name == '' ? 'Nigeria' : country_name;
    $.getJSON(`https://restcountries.eu/rest/v2/name/${country}`, function(response) {
        const symbol = response[0].currencies[0].symbol;
        $('#currency_symbol').text(symbol);
    });
}
