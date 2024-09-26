<?php
// Include the database connection
// include 'roxcon.php';

// Fetch document types from the dts_docstype table
$doc_types_query = "SELECT doctype_id, doctype_description FROM dts_docstype";
$doc_types_result = mysqli_query($conn, $doc_types_query);

// Fetch sections from the dts_sections table
$sections_query = "SELECT section_id, section_description FROM dts_sections";
$sections_result = mysqli_query($conn, $sections_query);
?>

<!-- Add Document Form (Bootstrap Styled) -->
<div class="container mt-4">
    <h3 class="mb-4">Add New Document</h3>
    <form action="submit_document.php" method="POST" id="addDocumentForm" class="needs-validation" novalidate>
        <div class="row">
            <!-- Document Type -->
            <div class="col-md-6 mb-3">
                <label for="doc_type">Document Type</label>
                <select name="doc_type" id="doc_type" class="form-control" required>
                    <option value="">Select Document Type</option>
                    <?php while ($row = mysqli_fetch_assoc($doc_types_result)) : ?>
                        <option value="<?php echo $row['doctype_id']; ?>"><?php echo $row['doctype_description']; ?></option>
                    <?php endwhile; ?>
                </select>
                <div class="invalid-feedback">
                    Please select a document type.
                </div>
            </div>

            <!-- Receiving Section (To) -->
            <div class="col-md-6 mb-3">
                <label for="section_to">To:</label>
                <select name="section_to" id="section_to" class="form-control" required>
                    <option value="">Select Receiving Section</option>
                    <?php while ($row = mysqli_fetch_assoc($sections_result)) : ?>
                        <option value="<?php echo $row['section_id']; ?>"><?php echo $row['section_description']; ?></option>
                    <?php endwhile; ?>
                </select>
                <div class="invalid-feedback">
                    Please select a receiving section.
                </div>
            </div>
        </div>

        <!-- Document Description -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="docs_description">Details</label>
                <textarea name="docs_description" id="docs_description" class="form-control" rows="3" required></textarea>
                <div class="invalid-feedback">
                    Please provide document details.
                </div>
            </div>
        </div>

        <!-- Personnel -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="personnel">Personnel</label>
                <select name="personnel" id="personnel" class="form-control" required>
                    <option value="">Select Personnel</option>
                    <!-- Options will be populated dynamically via JavaScript -->
                </select>
                <div class="invalid-feedback">
                    Please select a personnel.
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Include jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    // When the "To" (Receiving Section) is changed, update the Personnel dropdown
    $('#section_to').on('change', function () {
        var section_id = $(this).val();

        if (section_id) {
            $.ajax({
                type: 'POST',
                url: 'get_personnel.php', // The PHP script to fetch personnel based on section
                data: { section_id: section_id },
                success: function (response) {
                    $('#personnel').html(response);
                }
            });
        } else {
            $('#personnel').html('<option value="">Select Personnel</option>');
        }
    });
</script>

<!-- Enable Bootstrap validation -->
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
