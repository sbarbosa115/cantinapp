<div class="form-group">
    <label for="recipient-name" class="form-control-label">Name:</label>
    <input type="text" class="form-control" name="name" placeholder="Place here the name for employee" value="{{ old('name', $item->name) }}">
    @if($errors->first('name'))
        <div class="form-control-feedback">{{$errors->first('name')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="recipient-name" class="form-control-label">Username:</label>
    <input type="text" class="form-control" name="username" placeholder="Place here the username for employee" value="{{ old('username', $item->username) }}">
    @if($errors->first('username'))
        <div class="form-control-feedback">{{$errors->first('username')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="recipient-name" class="form-control-label">Birth Date:</label>
    <input type="text" class="form-control" name="birth_date" placeholder="Place here the employee's birth date" value="{{ old('birth_date', $item->birth_date) }}">
    @if($errors->first('birth_date'))
        <div class="form-control-feedback">{{$errors->first('birth_date')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="recipient-name" class="form-control-label">Email:</label>
    <input type="text" class="form-control" name="email" placeholder="Place here the email for employee" value="{{ old('email', $item->email) }}">
    @if($errors->first('email'))
        <div class="form-control-feedback">{{$errors->first('email')}}</div>
    @endif
</div>

<div class="form-group">
    <label for="recipient-name" class="form-control-label">Password:</label>
    <input type="password" class="form-control" name="password" placeholder="Place here the employee's password access" value="">
    @if($errors->first('password'))
        <div class="form-control-feedback">{{$errors->first('password')}}</div>
    @endif
</div>

<div class="form-group">
    <a class="btn btn-info" href="{{ route("restaurant.employee.index") }}">Go Back</a>
    <input type="submit" class="btn btn-success" value="Save Employee">
</div>