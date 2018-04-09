<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Item Manager</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
<main role="main" class="container">
    <h1>Add Item</h1>
    <form id="itemForm">
        <div>
            <label>text</label>
            <input type="text" id="text" class="form-control">            
        </div>
        <div>
            <label>Body</label>
            <textarea id="body" class="form-control"></textarea>            
        </div>
        <input type="submit" value="submit" class="bt btn-primary">
        <br>
    </form>
    <div class="starter-template">
        <ul id="items" class="list-group">

        </ul>
    </div>
</main>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        var url_api= 'http://restapi.test/api/items';

        // get and show all items
        function getItems(){
            $.ajax({
            url:url_api,
            type:'GET',
            success:function(data){
              var output= '';
              console.log(data);
            data.forEach(item => {
            output+='<li class="list-group-item"><strong>'+item.text+' : </strong>'+item.body+'<a href="#" class="deleteLink" data-id="'+item.id+'">delete</a></li>';
            });
            console.log(output);
            $('#items').append(output);
            },
            error: function(e){
                console.log(e.responseText);
            }
        });
        }
        //add event
        $('#itemForm').on('submit', function(e){
            e.preventDefault();

            var text = $('#text').val();
            var body = $('#body').val();

            addItem(text, body);
        });

        // add item function
        function addItem(text, body){
            $.ajax({
            url:url_api,
            type:'POST',
            data : {text: text, body: body},
            success:function(data){
            alert('Item # '+data.id+'added');

              location.reload();
            },
            error: function(e){
                console.log(e.responseText);
            }
        });
        }

        //Delete event
        $('body').on('click','.deleteLink',function(e){
            e.preventDefault();

            var id = $(this).data('id');
            
            deleteItem(id);
        });

        //deelete function
        
        function deleteItem(id){
            $.ajax({
            url:url_api+'/'+id,
            type:'POST',
            data : {_method: 'DELETE'},
            success:function(data){
            alert('Item Removed',id);

              location.reload();
            },
            error: function(e){
                console.log(e.responseText);
            }
        });
        }

        //call to the get items function
        getItems();
    });
</script>

</body>
</html>