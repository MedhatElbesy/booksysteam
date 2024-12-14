<x-app-layout>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Books</h1>

            <!-- Filtering Form -->
            <form method="GET" action="{{ route('books.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="term_id">Term</label>
                        <select name="term_id" id="term_id" class="form-control">
                            <option value="">All Terms</option>
                            @foreach($terms as $term)
                                <option value="{{ $term->id }}" {{ request('term_id') == $term->id ? 'selected' : '' }}>
                                    {{ $term->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="stage_id">Stage</label>
                        <select name="stage_id" id="stage_id" class="form-control">
                            <option value="">All Stages</option>
                            @foreach($stages as $stage)
                                <option value="{{ $stage->id }}" {{ request('stage_id') == $stage->id ? 'selected' : '' }}>
                                    {{ $stage->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="grade_id">Grade</label>
                        <select name="grade_id" id="grade_id" class="form-control" disabled>
                            <option value="">All Grades</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3" id="extra-input-container" style="display: none;">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="أدبي">أدبي</option>
                            <option value="علمي">علمي</option>
                        </select>
                    </div>


                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            @if(auth()->user()->user_type == 'admin')
                <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Upload Book</a>
            @endif
            <!-- Books Table -->
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <!-- <th>User</th> -->
                        <th>Term</th>
                        <th>Stage</th>
                        <th>Grade</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->name }}</td>
                            <!-- <td>{{ $book->user->name }}</td> -->
                            <td>{{ $book->term->name }}</td>
                            <td>{{ $book->stage->name }}</td>
                            <td>{{ $book->grade->name }}</td>
                            <td>{{ $book->type ?? '--' }}</td>
                            <td>
                                <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm">Print</a>
                                @if(auth()->user()->user_type == 'admin')

                                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No books available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function() {
                $('#grade_id').prop('disabled', true);
                $('#term_id, #stage_id').on('change', function() {
                    var termId = $('#term_id').val();
                    var stageId = $('#stage_id').val();

                    $('#grade_id').prop('disabled', true).empty().append('<option value="">Select Grade</option>');
                    $('#extra-input-container').hide();
                    if (termId && stageId) {
                        fetchGradesByTermAndStage(termId, stageId);
                        $('#grade_id').prop('disabled', false);
                    } else {
                        $('#grade_id').prop('disabled', true);
                        $('#extra-input-container').hide();
                    }
                });


                function fetchGradesByTermAndStage(termId, stageId) {
                    $.ajax({
                        url: '/grades-by-term-stage/' + termId + '/' + stageId,
                        method: 'GET',
                        success: function(data) {
                            var gradeSelect = $('#grade_id');
                            gradeSelect.empty();
                            gradeSelect.append('<option value="">Select Grade</option>');
                            $.each(data, function(index, grade) {
                                gradeSelect.append('<option value="' + grade.id + '">' + grade.name + '</option>');
                            });

                            gradeSelect.on('change', function() {
                                var selectedGrade = $(this).val();
                                if (selectedGrade == '11' || selectedGrade == '12' || selectedGrade == '23' || selectedGrade == '24') {
                                    $('#extra-input-container').show();
                                } else {
                                    $('#extra-input-container').hide();
                                }
                            });
                        }
                    });
                }
            });
        </script>
    </body>
</x-app-layout>
