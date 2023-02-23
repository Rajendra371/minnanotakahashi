<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta Tag -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>GiftedHands - Maintenance</title>
<style>
  body { text-align: center; padding: 100px; overflow: hidden;}
  h1 { font-size: 50px; }
  body { font: 20px Helvetica, sans-serif; color: #333; }
  article { display: block; text-align: left; width: 650px; margin: 0 auto; }
  
  .input{
    height: 40px;
    border: 1px solid rgba(204, 204, 204, 0.75);
    width: 50%;
    margin-bottom: 10px;
    display: block;
    border-radius: 0px;
    padding: 0px 15px 0 40px;
    font-size: 14px;
    font-weight: normal;
  }
  .btn{
    text-align: center;
    margin: 0;
    padding: 10px 20px;
    background: #e20c30;
    color: #fff;
    font-size: 15px;
    border-radius: 0px;
    text-transform: capitalize;
    display: inline-block;
    border: 2px solid transparent;
    margin-right: 15px;
    letter-spacing: 0.05em;
    cursor: pointer;:
  }
    .btn:hover {
    background: #7aaedd;
    color: #fff;
    box-shadow: 0 10px 10px -8px rgb(0 0 0 / 50%);
}
</style>

<article>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you have the key you can access the site, otherwise we&rsquo;ll be back online shortly!</p>
        <p>&mdash; GiftedHands</p>
        <form action="{{route('maintenance')}}" method="post">
        @csrf
        <input type="text" name="key" id="key" class="input" placeholder="Enter Maintenance Key." autocomplete="off">
        <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</article>