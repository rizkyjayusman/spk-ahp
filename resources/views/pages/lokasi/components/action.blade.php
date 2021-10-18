<a class="btn btn-sm btn-danger btn-rounded" style="padding: .375rem .5625rem;" href="{{ url('/lokasi/edit', array('lokasiId' => $row->id)) }}">Edit</a>
<a href="#" 
    data-id="{{ $row->id }}" 
    data-url="{{ url('/api/lokasi/delete', array('lokasiId' => $row->id)) }}" 
    class="btn btn-sm btn-warning  btn-rounded remove-user-btn" style="padding: .375rem .5625rem;">
        Delete
</a>