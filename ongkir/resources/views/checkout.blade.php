<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #363062;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .form-control {
            height: 28px !important;
        }


        .container {
            background-color: #F99417;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .ps-checkout__form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        #service-cards-container {
            margin-top: 20px;
            /* width: 50%; */
            align-items: center;
            justify-content: center;
        }

        .custom-card {
            background-color: #4D4C7D;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .custom-card:hover {
            transform: scale(1.05);
        }

        .custom-card .card-body {
            padding: 15px;
        }

        .custom-card .card-title {
            font-size: 25px;
            margin-bottom: 10px;
            color: #fff;
            font-weight: 800;
        }

        .custom-card .card-text {
            margin-bottom: 5px;
            color: #fff;
        }

        .loader {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-block;
            border-top: 4px solid #FFF;
            border-right: 4px solid transparent;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .loader::after {
            content: '';
            box-sizing: border-box;
            position: absolute;
            left: 0;
            top: 0;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border-left: 4px solid #FF3D00;
            border-bottom: 4px solid transparent;
            animation: rotation 0.5s linear infinite reverse;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .select2-selection {
            overflow: hidden;
        }

        .select2-selection__rendered {
            white-space: normal;
            word-break: break-all;
        }
    </style>
    <title>checkout</title>
</head>

<body>
    <div class="container">
        <form class="ps-checkout__form" action="" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group form-group--inline">
                        <label for="provinsi">Provinsi asal</label>
                        <select name="province_origin" id="province_asal" class="form-control">
                            <option value="5" namaprovinsi="DI Yogyakarta">DI Yogyakarta</option>
                        </select>
                    </div>
                    <div class="form-group form-group--inline">
                        <label for="kota">Kota asal</label>
                        <select name="kota_origin" id="kota_asal" class="form-control">
                            <option value="501" namaprovinsi="Kota Jogja">Kota Jogja</option>
                        </select>
                    </div>
                    <div class="form-group form-group--inline">
                        <label>Total berat (gram) </label>
                        <input class="form-control" value="200" type="text" id="weight" name="weight">
                    </div>

                    <div class="form-group form-group--inline">
                        <label for="provinsi">Provinsi Tujuan<span>*</span></label>
                        <select name="province_id" id="province_id" class="form-control">
                            <option value="">Provinsi Tujuan</option>
                            @foreach ($provinsi as $row)
                            <option value="{{$row['province_id']}}" namaprovinsi="{{$row['province']}}">{{$row['province']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="nama_provinsi" nama="nama_provinsi" placeholder="ini untuk menangkap nama provinsi ">
                    </div>

                    <div class="form-group">
                        <label>Kota Tujuan<span>*</span></label>
                        <select name="kota_id" id="kota_id" class="form-control">
                            <option value="">Pilih Kota</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Pilih Ekspedisi<span>*</span></label>
                        <select name="kurir" id="kurir" class="form-control">
                            <option value="">Pilih kurir</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS INDONESIA</option>
                        </select>
                    </div>

                </div>
                <span class="loader"></span>
            </div>
        </form>
        <div id="service-cards-container"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            function formatRupiah(angka) {
                var number_string = angka.toString();
                var split = number_string.split(',');
                var sisa = split[0].length % 3;
                var rupiah = split[0].substr(0, sisa);
                var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp ' + rupiah;
            }

            $('#province_id, #kota_id, #kurir, #kota_asal,#province_asal').select2({
                width: '100%'


            });
            $('.loader').hide();
            $('select[name="province_id"]').on('change', function() {
                var namaprovinsiku = $("#province_id option:selected").attr("namaprovinsi");
                $("#nama_provinsi").val(namaprovinsiku);
                let provinceid = $(this).val();
                if (provinceid) {
                    $.ajax({
                        url: "/kota/" + provinceid,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            $('.loader').show();
                        },
                        success: function(data) {
                            $('select[name="kota_id"]').empty();
                            $('.loader').hide();

                            $.each(data, function(key, value) {
                                $('select[name="kota_id"]').append('<option value="' + value.city_id + '" namakota="' + value.type + ' ' + value.city_name + '">' + value.type + ' ' + value.city_name + '</option>');
                            });
                        },
                        error: function() {
                            $('.loader').hide();
                            alert('Error occurred while fetching data.');
                        }
                    });
                } else {
                    $('select[name="kota_id"]').empty();
                }
            });

            $('select[name="kurir"]').on('change', function() {
                let origin = $("select[name=kota_origin]").val();
                let destination = $("select[name=kota_id]").val();
                let courier = $("select[name=kurir]").val();
                let weight = $("input[name=weight]").val();
                if (courier) {
                    $.ajax({
                        url: "/origin=" + origin + "&destination=" + destination + "&weight=" + weight + "&courier=" + courier,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            $('.loader').show();
                        },
                        success: function(data) {
                            let cardContainer = $('#service-cards-container');
                            cardContainer.empty();
                            $('.loader').hide();

                            $.each(data, function(key, value) {
                                $.each(value.costs, function(key1, value1) {
                                    $.each(value1.cost, function(key2, value2) {
                                        let cardHtml = '<div class="card custom-card">';
                                        cardHtml += '<div class="card-body">';
                                        cardHtml += '<h5 class="card-title">' + value1.service + '</h5>';
                                        cardHtml += '<p class="card-text">' + value1.description + '</p>';
                                        cardHtml += '<p class="card-text"><strong>Biaya :</strong> ' + formatRupiah(value2.value) + '</p>';
                                        cardHtml += '<p class="card-text"><strong>Estimasi :</strong> ' + value2.etd + '</p>';
                                        cardHtml += '</div>';
                                        cardContainer.append(cardHtml);
                                    });
                                });
                            });
                        },
                        error: function() {
                            $('.loader').hide();
                            alert('Error occurred while fetching data.');
                        }
                    });
                } else {
                    $('select[name="layanan"]').empty();
                }
            });
        });
    </script>

</body>

</html>