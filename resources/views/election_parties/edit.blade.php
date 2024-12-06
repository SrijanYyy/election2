@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Elections/Edit</span>
@endsection

@section('content')
<div class="row">
    <div class="col-xxl-12">
        @include('components.message-flash')

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Form to Edit Entry -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Edit</h5>
                </div>
                <hr>
                <form action="{{ route('election_parties.update', $election_party->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <!-- Election Dropdown -->
                        <div class="col-md-6">
                            <label for="election" class="form-label">Election</label>
                            <select class="form-control" id="election" name="election_id" required>
                                <option value="">Select Election</option>
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}" {{ $election_party->election_id == $election->id ? 'selected' : '' }}>{{ $election->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Party Fields Container -->
                    <div id="party-container">
                        @foreach($election_party->parties as $index => $party)
                            <div class="party-fields row mb-3" id="row{{ $index + 1 }}">
                                <div class="col-md-6">
                                    <label for="party_name" class="form-label">Party Name</label>
                                    <select class="form-control" id ="party" name="party_id[]" required>
                                        <option value="">Select Party</option>
                                        @foreach($partys as $party)
                                            <option value="{{ $party->id }}" {{ $party->id == $party->id ? 'selected' : '' }}>{{ $party->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" name="remove" id="{{ $index + 1 }}" class="btn btn-danger btn_remove">X</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Party Button -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary" id="add-party">Add Party</button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mb-3">
                        <div class="col-md-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
 
  
  $(document).ready(function() {
    var i = 1;
    // Pre-render the options using Blade
    var partyOptions = `{!! json_encode($partys->map(fn($party) => '<option value="'.$party->id.'">'.$party->name.'</option>')->join('')) !!}`;

    // Add Party Button Click Event
    $("#add-party").click(function() {
      i++;
      // Append Party Fields
      $('#party-container').append(
        `<div class="party-fields row mb-3" id="row${i}">
          <div class="col-md-6">
            <label for="party_name" class="form-label">Party Name</label>
            <select class="form-control" name="party_id[]" required>
              <option value="">Select Party</option>
              ${partyOptions}
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">X</button>
          </div>
        </div>`
      );
    });

    // Remove Party Field
    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id).remove();
    });

    // Form Submission
    $("form[name='add-party']").submit(function(event) {
      event.preventDefault(); // Prevent form from submitting normally
      var formdata = $(this).serialize();
      console.log(formdata);

      $.ajax({
        url: "/election_parties/edit",
        type: "PUT",
        data: formdata,
        cache: false,
        success: function(result) {
          alert(result);
          $("form[name='add-party']")[0].reset();
        }
      });
    });
  });
</script>
@endsection
