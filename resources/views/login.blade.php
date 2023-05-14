@extends('layout.app')
@section("content")
<div class="container">
<form >
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    <div id="email-error" class="text-danger"></div> 
</div>
  <div class="mb-3">
    <label for="password" class="form-label">Password:</label>
    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    <div id="password-error" class="text-danger"></div>  
</div>
  <button type="submit" class="btn btn-primary" id="loginBtn">Submit</button>
</form>
</div>
@stop