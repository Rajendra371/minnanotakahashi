@if (!$trainings->isEmpty())
@foreach ($trainings as $training)
<tr>
  <td class="pt-3-half">{{$loop->iteration}}</td>
  <td class="pt-3-half text-left">{{$training->title}}</td>
  <td class="pt-3-half">
      @if (in_array($training->id,$employee_trainings))
        Completed
      @else
      <input type="checkbox" class="trainings" data-id="{{$loop->iteration}}" name="trainings[]" value="{{$training->id}}"  />
      <input type="file" class="attachments" id="{{ "file_$loop->iteration" }}" name="attachments[]" style="display: none" />
      @endif
  </td>
</tr>
@endforeach
@endif