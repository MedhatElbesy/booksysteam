<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container mt-5">
        <h1 class="mb-4">Upload Book</h1>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter book name" required>
            </div>

            <div class="form-group">
                <label for="term_id">Term</label>
                <select name="term_id" id="term_id" class="form-control" required>
                    @foreach($terms as $term)
                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stage_id">Stage</label>
                <select name="stage_id" id="stage_id" class="form-control" required>
                    @foreach($stages as $stage)
                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="grade_id">Grade</label>
                <select name="grade_id" id="grade_id" class="form-control" required>
                    <option value="">Select Grade</option>
                </select>
            </div>

            <div class="mb-3" id="extra-input-container" style="display:none;">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="أدبي">أدبي</option>
                    <option value="علمي">علمي</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="file" class="form-label">PDF File</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Upload</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <script>
        // Fetch grades based on selected term and stage
        $('#term_id, #stage_id').on('change', function() {
            var termId = $('#term_id').val();
            var stageId = $('#stage_id').val();

            if (termId && stageId) {
                fetchGradesByTermAndStage(termId, stageId);
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

                    $('#grade_id').on('change', function() {
                        var selectedGrade = $(this).val();
                        console.log(selectedGrade);

                        if (selectedGrade == '11' || selectedGrade == '12' || selectedGrade == '23' || selectedGrade == '24') {
                            $('#extra-input-container').show();
                        } else {
                            $('#extra-input-container').hide();
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>
