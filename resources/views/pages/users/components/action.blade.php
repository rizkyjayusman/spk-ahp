<a class="btn btn-sm btn-danger btn-rounded" style="padding: .375rem .5625rem;" href="{{ url('/users/edit', array('userId' => $row->id)) }}">Edit</a>
<a href="#" 
    data-id="{{ $row->id }}" 
    data-url="{{ url('/api/users/delete', array('userId' => $row->id)) }}" 
    class="btn btn-sm btn-warning  btn-rounded remove-user-btn" style="padding: .375rem .5625rem;">
        Delete
</a>