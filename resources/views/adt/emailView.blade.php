<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container bg-white" style="margin-top:50px;padding:10px">
        <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width:4%">#</th>
                    <th scope="col" style="width:14%">Name</th>
                    <th scope="col" style="width:20%">Adresse Email</th>
                    <th scope="col" style="width:7%">Subject</th>
                    <th scope="col" style="width:32%">Message</th>
                    <th scope="col" style="width:23%">Action</th>
                  </tr>
                </thead>
                <tbody>
                        @foreach ($emails as $email)
                        <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $email->name }}</td>
                                <td>{{ $email->adresse }}</td>
                                <td>{{ $email->subject }}</td>
                                <td>.{{ $email->message }}</td>
                            </tr>
                        @endforeach
                </tbody>
        </table>
    </div>
</body>
</html>