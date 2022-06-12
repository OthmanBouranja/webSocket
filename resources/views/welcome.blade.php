<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
<div class="contanier">
    <div class="card-body">
        <div class="form-group">
            <input id="name" type="text" class="form-control"  >
        </div>
            <div class="form-group" id="data-message">

            </div>
            <div class="form-group">
                <textarea id="message" class="form-control" ></textarea>
            </div>

           
            <button onclick="playSound('https://file-examples.com/storage/fea5852d3d62a659ea2668c/2017/11/file_example_MP3_700KB.mp3');">Play</button>
        <button class="btn btn-block btn-primary">Send</button>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{url('js/app.js')}}"></script>
    <script>


        $(function(){
            const Http = window.axios;
            const Echo = window.Echo;
            const name = $("#name");
            const message = $("#message");
            console.log(message);

            $("input, textarea").keyup(function(){
                $(this).removeClass('is-invalid');
            });

            $('button').click(function(){
             
                if(name.val() == ''){
                    name.addClass('is-invalid')
                }else if (message.val() == ''){
                    message.addClass('is-invalid')
                }else{
                    Http.post("{{ url('send') }}", {
                    'name' : name.val(),
                    'message' : message.val(),
                    }).then(()=>{
                        name.val('');
                        message.val('');
                    });
                }

            })

            try {
                let channel = Echo.channel('channel-name');
                channel.listen('MyEvent', function(data){

                   
                    // alert('Received my-event with message: ');
                    $('#data-message')
                                       
                    .append(`
                    <div class="alert alert-primary" role="alert">
                        <strong>${data.message.name}</strong> :  ${data.message.message}<br>
                </div>
                    
                    `);


                })
                setTimeout(function(){
                    $('#data-message').remove();
                    }, 6000);
            } catch (error) {
                console.log(error);
            }
            

        })
    </script>
  </body>
</html>