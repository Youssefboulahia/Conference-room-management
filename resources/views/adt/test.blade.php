<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="bg-white">
        <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width:4%">#</th>
                    <th scope="col" style="width:14%">Utilisateur</th>
                    <th scope="col" style="width:20%">Sprint</th>
                    <th scope="col" style="width:32%">Message</th>
                    <th scope="col" style="width:7%">Format</th>
                    <th scope="col" style="width:23%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($filterSprint==="null")
                        @foreach ($fichiers as $fichier)
                        <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $fichier->importeur->name }}</td>
                                <td>{{ $fichier->sprint->name }}</td>
                                <td>{{ $fichier->message }}</td>
                                <td>.{{ $fichier->format }}</td>
                                <td>
                                 
                                      <a href="{{ route('fichier.download',$fichier->id) }}" class="btn btn-primary btn-sm text-white"><i class="fa fa-download" aria-hidden="true"></i><span class="ml-1">Télécharger</span></a>    
                                      @if ($fichier->format==='pdf'||$fichier->format==='txt'||$fichier->format==='jpeg'||$fichier->format==='png'||$fichier->format==='html')
                                         <a href="{{ route('fichier.voir',$fichier->id) }}" class="btn btn-outline-primary btn-sm text-primary"><i class="fa fa-eye" aria-hidden="true"><span class="ml-1">Ouvrir</span></i></a>    
                                      @else
                                         <a  class="btn btn-outline-dark btn-sm text-muted" style="pointer-events: none;"><i class="fa fa-eye" aria-hidden="true"><span class="ml-1">Ouvrir</span></i></a>     
                                      @endif                
                                      
                                      <input type="text" hidden value="{{ $fichier->id }}" name="fichier">
                                      @if((Auth()->user()->isProductOwner($project->id)))
                                      <button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete" data-id="{{ $fichier->id }}"><i class="fas fa-trash-alt"></i></button>  
                                      @elseif( !(Auth()->user()->isProductOwner($project->id)) )
                                         @foreach (Auth()->user()->fichiers as $fch )
                                             @if ($fichier->id === $fch->id)
                                                 <button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete" data-id="{{ $fichier->id }}"><i class="fas fa-trash-alt"></i></button>  
                                             @endif
                                         @endforeach
                                      @endif
                                     
                                </td>
                            </tr>
                        @endforeach
</body>
</html>



@foreach ($emails as $email )
                <div class="container">
                        <div class="card text-center" style="margin-top:60px; box-shadow:black 0px 0.5px 1.5px;border:solid #ccc 0.5px">
                                <div class="card-header">
                                       <div class="row" style="font-size:18px">
                                           <div class="col-sm-6">
                                                <strong style="color:#2d3549">Name:</strong> <span style="">{{ $email->name }}</span>
                                           </div>
                                           <div class="col-sm-6">
                                                <strong style="color:#2d3549">Email:</strong> <span style="">{{ $email->adresse }}</span>
                                           </div>
                                       </div>
                                </div>
                                <div class="card-body">
                                <h5 class="card-title text-left" style="font-size:18px"><strong style="color:#2d3549">Subject:</strong> <span style="color:#2b2c2d; font-size:19px">{{ $email->subject }}</span></h5>
                                <p class="card-text text-left" style="font-size: 18px; margin-top:19px"> {{ $email->message }}</p>
                                </div>
                                <div class="card-footer text-muted">
                                {{ $email->created_at->format('d/m/Y') }}
                                </div>
                          </div>
                </div>
    @endforeach