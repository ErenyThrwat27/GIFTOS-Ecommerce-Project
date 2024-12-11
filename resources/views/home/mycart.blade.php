<!DOCTYPE html>
<html>

<head>
 @include('home.css')
 <style type="text/css">
    .div_deg
    {
        display: flex;
        justify-content: center;
        align: center;
        margin: 60px;
    }
    table
    {
        border: 2px solid black;
        text-align: center;
        width: 800px;
    }
    th
    {
        border: 2px solid black; 
        text-align: center;
        color: white;
        font: 20px;
        font-weight: bold;
        background-color: black;
    }
    td
    {
        border: 2px solid black;
    }
    .cart_value
    {
        text-align: center;
        margin-bottom: 70px;
        padding: 18px;
    }
    .order_deg
    {
        padding-right: 100px;
        margin-top: -100px;
        text-align: center;
    }
    label
    {
        display: inline-block;
        width: 150px;
    }
    .div_gap
    {
        padding: 20px;
    }
    
 </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>

  
  <div class="div_deg">

 
    <table>
        <tr>
            <th>Product title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Remove</th>
        </tr>
        <?php
        $value=0;

        ?>
        @foreach($cart as $cart)
        <tr>
            
            <td>{{$cart->product->title}}</td>
            <td>{{$cart->product->price}}</td>
            <td>
                <img width="150" src="/products/{{$cart->product->image}}">
            </td>
            <td>
                <a class="btn btn-danger" href="{{url('delete_cart',$cart->id)}}">Remove</a>
            </td>
        </tr>

        <?php
        $price = is_numeric($cart->product->price) ? floatval($cart->product->price) : 0;
        $value += $price;  // Accumulate total value
        ?>
        @endforeach
    </table>
  </div>
  
  <div class="cart_value">
    <h3>Totale value of Cart is: ${{$value}}</h3>
  </div>


  <div class="order_deg" >
    <form action="{{url('comfirm_order')}}" method="post">
        @csrf
        <div class="div_gap">
            <label>Reciever Name</label>
            <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>
        <div class="div_gap">
            <label>Reciever Address</label>
            <textarea name="address">{{Auth::user()->address}}</textarea>
        </div>
        <div class="div_gap">
            <label>Reciever Phone</label>
            <input type="text" name="phone" value="{{Auth::user()->phone}}">
        </div>
        <div class="div_gap">
            <input class="btn btn-primary" type="submit" value="Cash On Delivery">
            <a class="btn btn-success" href="{{url('stripe',$value)}}">Pay Using Card</a>
        </div>
    </form>
  </div>
  
 

  <!-- info section -->

  @include('home.footer')

</body>

</html>