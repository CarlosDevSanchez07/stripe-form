<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</head>
<body>
<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <h2 class="text-center my-4">Mi donación</h2>

            <div class="my-4">
                <h4>Frecuencía</h4>
                <div class="input-group">
                    <div id="radioBtn" class="row ml-0">
                        <a class="btn btn-primary btn-md mx-1 active" data-toggle="frequency" data-title="one">Una vez</a>
                        <a class="btn btn-primary btn-md mx-1 notActive" data-toggle="frequency" data-title="month">Mensual</a>
                    </div>
                    <input type="hidden" name="frequency" id="frequency">
                </div>
            </div>

            <div class="my-4">
                <h4>Quiero donar:</h4>
                <div class="input-group">
                    <div id="radioBtnPrice" class="row ml-0">
                        <a class="btn btn-primary btn-md mx-1 noActive" data-toggle="price" data-title="75">$ 75</a>
                        <a class="btn btn-primary btn-md mx-1 notActive" data-toggle="price" data-title="125">$ 125</a>
                        <a class="btn btn-primary btn-md mx-1 notActive" data-toggle="price" data-title="250">$ 250</a>
                        <a class="btn btn-primary btn-md mx-1 notActive" data-toggle="price" data-title="500">$ 500</a>
                        <a class="btn btn-primary btn-md mx-1 notActive" data-toggle="price" data-title="1000">$ 1000</a>
                        <input id="price-custom" type="number" min="10" placeholder="Otra cantidad" class="input-control" />
                    </div>
                    <p>$10 es la donación mínima en línea. Todas las donaciones son deducibles de impuestos.</p>
                    <input type="hidden" name="price" id="price">
                </div>
            </div>

            <div class="my-4">
                <div class="alert alert-secondary">
                    <div class="form-check abc-checkbox">
                        <input class="form-check-input" id="tarifa" type="checkbox">
                        <label class="form-check-label" for="tarifa">
                        Por favor agregue $<span id="percentage">0</span> para cubrir las tarifas de procesamiento y otros gastos asociados con mi donación.
                        </label>
                    </div>
                </div>
            </div>

            <div class="my-4">
                <h4>Quiero apoyar:</h4>
                <select class="custom-select" name="apoyar" id="apoyar">
                    <option></option>
                    <option value="Ayuda en caso de desastres">Ayuda en caso de desastres</option>
                    <option value="Donde más se necesita">Donde más se necesita</option>
                    <option value="Su Cruz Roja local">Su Cruz Roja local</option>
                    <option value="Servicios de sangre">Servicios de sangre</option>
                </select>
            </div>

            <div class="my-4">
                <h4>Quiero apoyar:</h4>
                <div class="form-check abc-checkbox">
                    <input class="form-check-input" id="dedicatoria" type="checkbox">
                    <label class="form-check-label" for="dedicatoria">
                        Dedicar a un amigo o ser querido
                    </label>
                </div>
                <div id="dedicatoria-visible" class="mt-1" style="display:none;">
                    <input name="dedicatoria-input" id="dedicatoria-input" class="form-control" placeholder="Nombre" />
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center my-4">
        <aside class="col-md-12 col-sm-12">
            <div class="row justify-content-center">
                <div class="col-md-3" style="height: 120px;">
                    <div id="select_payment" class="card card-body text-center" style="cursor:pointer;height: 120px;">
                        <div style="height: 40px">
                            <i class="fab fa-cc-visa fa-lg pr-1"></i>
                            <i class="fab fa-cc-amex fa-lg pr-1"></i>
                            <i class="fab fa-cc-mastercard fa-lg"></i>
                        </div>
                        <p>Tarjeta de credito</p>
                    </div>
                </div>
                <div class="col-md-3" style="height: 120px;">
                    <div class="card card-body text-center" style="cursor:pointer;height: 120px;">
                        <div class="">
                            <img src="https://play-lh.googleusercontent.com/YCT9pYI8KOkOuvVtAkB8103BektOn973BW-t4srwhSMbpj0HUVQf10hVusFpmTTbHg" height="40px" />
                        </div>
                        <p>Mercado pago</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <div id="payment_card" style="display:none;">
        <div class="row justify-content-center mb-4">
            <aside class="col-md-8 col-sm-12">
                <article class="card">
                    <div class="card-body p-5">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">
                                <p id="message-form" class=""></p>
                                <form role="form" method="POST" id="paymentFormStripe" action="{{ url('/payment')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Nombre completo (como viene en la tarjeta)</label>
                                        <input type="text" class="form-control" name="fullName" placeholder="Nombre completo">
                                    </div>
                                    <div class="form-group" id="email">
                                        <label for="email">Correo electronico</label>
                                        <input type="email" class="form-control" name="email" placeholder="Correo electronico">
                                    </div>
                                    <div class="form-group">
                                        <label for="cardNumber">Número tarjeta</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cardNumber" placeholder="Número tarjeta">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                                <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                                <i class="fab fa-cc-mastercard fa-lg"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label><span class="hidden-xs">Fecha de expiración</span> </label>
                                                <div class="input-group">
                                                    <select class="form-control" name="month">
                                                        <option value="">MM</option>
                                                        @foreach(range(1, 12) as $month)
                                                            <option value="{{$month}}">{{$month}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select class="form-control" name="year">
                                                        <option value="">YYYY</option>
                                                        @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label data-toggle="tooltip" title=""
                                                    data-original-title="3 digits code on back side of the card">CVV <i
                                                    class="fa fa-question-circle"></i></label>
                                                <input type="password" class="form-control" placeholder="CVV" name="cvv">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="subscribe btn btn-primary btn-block" type="submit"> Confirmar </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </aside>
        </div>
    </div>
</main>
<script>
    $('#radioBtn a').on('click', function(){
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#'+tog).prop('value', sel);
        
        $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    })

    $('#radioBtnPrice a').on('click', function(){
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#'+tog).prop('value', sel);

        const percentage = sel * 0.025;
        $("#percentage").text(Number(percentage).toFixed(2));
        
        $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    })

    $("#price-custom").on("keyup", function(){
        var sel = $(this).val();
        const percentage = sel * 0.025;
        $("#percentage").text(Number(percentage).toFixed(2));
    })

    $("#select_payment").on("click", function(){
        $("#payment_card").css("display", "block");
    })

    $("#dedicatoria").on("change", function(){
        if($(this).is(':checked')){
            $("#dedicatoria-visible").css("display", "block")
        }else{
            $("#dedicatoria-visible").css("display", "none")
        }
    })

    $("#paymentFormStripe").on("submit", function(e){
        e.preventDefault();
        var values = $(this).serializeArray();
        var payload = {}

        if(values && values.length > 0){
            for(let i = 0; i < values.length; i++){
                payload = {
                    ...payload,
                    [values[i].name]: values[i].value
                }
            }
        }

        if($("#price").val() == "" && $("#price-custom").val() == ""){
            alert("No ha seleccionado un precio");
            return;
        }

        payload = {
            ...payload,
            price: $("#price-custom").val() != "" ? $("#price-custom").val() :  $("#price").val(),
            fee: $("#tarifa").is(':checked'),
            support: $("#apoyar").val(),
            dedication: $("#dedicatoria").is(':checked'),
            nameDedication: $("#dedicatoria-input").val(),
            frequency: $("#frequency").val() == "" ? "una" : $("#frequency").val()
        }

        $.ajax({
            url : '/payment',
            data : payload,
            type : 'POST',
            dataType : 'json',
            success : function(json) {
                if(json && json.status){
                    $("#message-form").removeClass("alert-success");
                    $("#message-form").removeClass("alert-danger");


                    $("#message-form").addClass(`alert alert-${json.status}`);
                    $("#message-form").text(json.message);
                    if(json.status == "success"){
                        setTimeout(() => {
                            window.location.reload()
                        }, 4000);
                    }
                }
            },
            error : function(xhr, status) {
                alert('Disculpe, existió un problema');
            }
        });
    })
</script>
</body>
</html>