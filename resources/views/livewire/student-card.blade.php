<div>
<style>
   
</style>
<div class="container-fluid" style="border-radius:10px;">
<div class="card mb-3" style="max-width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <select id="name"  wire:model="selectedStudent"  class="form-select branchDrop"  name="Name">
        <option   value="">Select a Student</option>
        @if (is_array($students) || is_object($students))
        @foreach($students as $student)
            <option value="{{$student->id}}">{{$student->name}}</option>
        @endforeach
        @endif
    </select>
    </div>
    <div class="col-md-2">
      <img src="https://cdn.discordapp.com/attachments/948596391855394826/1108367985539817512/user_avtaar.png" alt="user_image" class="user_profile_avtaar" width="200">
      {{-- <i> <img class="card-img-top" src="{{url('assets/images/boys.png')}}" style="width:100px; height:100px;"></i> --}}

    </div>
    <div class="col-md-4">
      <div class="card-body">
        <h5 class="card-title">{{$student->name}}</h5>
        <table>
                      
          <tbody>
             
            
            <tr>
              <td class="text-center">Course :</td>
              <td class="text-center">{{$student->Course}}</td>
            </tr>
            <tr>
              <td class="text-center">Batch :</td>
              <td class="text-center"></td>
            </tr>
            <tr>
              <td class="text-center">Email :</td>
              <td class="text-center">{{$student->email}}</td>
            </tr>
            <tr>
              <td class="text-center">Mob :</td>
              <td class="text-center">{{$student->mob_no}}</td>
            </tr>

          
          </tbody>
        </table>      
      </div>
  
    </div>

  </div>
</div>

</div>

</div>