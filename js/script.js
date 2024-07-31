$(document).ready(function(){
	$('#enrolMdl').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var cid = button.data('cid'); // Extract data attributes from button
        var ctitle = button.data('ctitle');
        var cprice = button.data('cprice');
        var chapters = button.data('chapters');

        // Update modal content with data
        var modal = $(this);
        modal.find('.modal-body #cid').val(cid);
        modal.find('.modal-body #ectitle').text(ctitle);
        modal.find('.modal-body #ecprice').text(cprice);
        modal.find('.modal-body #ecchapters').text(chapters);
    });

    // edit course 
    $('#editCourseMdl').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var cid = button.data('cid'); // Extract data attributes from button
        var ecname = button.data('ecname');

        // Update modal content with data
        var modal = $(this);
        // modal.find('.modal-body #vcid').val(cid);
        modal.find('.modal-body #cid').val(cid);
        modal.find('.modal-body #ecname').val(ecname);
    });

    // edit subject modal
    $('#editSubjectMdl').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var sjid = button.data('sjid'); // Extract data attributes from button
        var esjname = button.data('esjname');
        var ecid = button.data('ecid');
        // var esjname = button.data('esjname');

        alert(ecid);

        // Update modal content with data
        var modal = $(this);
        // modal.find('.modal-body #vsjid').val(sjid);
        modal.find('.modal-body #sjid').val(sjid);
        modal.find('.modal-body #esjname').val(esjname);
        modal.find('.modal-body #ecidFirst').text(ecid);
    });

    // view lesson 
    $('#viewLessonMdl').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var path = button.data('path');
        var type = button.data('type'); // Extract data attributes from button
        var form = button.data('form');
        var lname = button.data('lname');

        // Update modal content with data
        var modal = $(this);
        // modal.find('.modal-body #vcid').val(cid);
        modal.find('.modal-body iframe').attr('src', path);
        modal.find('.modal-body .lname').text(lname);
        modal.find('.modal-body .type').text(type);
        modal.find('.modal-body .form').text(form);
        // alert(lname);
    });

    // When the modal is about to be hidden
    $('#viewLessonMdl').on('hide.bs.modal', function () {
        var modal = $(this);
        modal.find('.modal-body iframe').attr('src', ''); // Reset the src attribute
    });
	
	var chapters = $('.chapters').html();
	var comments = $('.commentsDiv').html();
	var width = $(window).width();
    $('.chaptersBtn').click(function (e) {
    	e.preventDefault();
    	// var chapters = $('.chapters').html();
    	$('.chaptersCommentsDiv').html();
    	$('.chaptersCommentsDiv').html(chapters);
    });

    $('.commentsBtn').click(function (e) {
    	e.preventDefault();
    	// var comments = $('.comments').html();
    	$('.chaptersCommentsDiv').html();
    	$('.chaptersCommentsDiv').html(comments);
    });

    if (width < 768) {
        $('.chaptersCommentsDiv').html(chapters);
    } else {
        $('.chaptersCommentsDiv').html(comments);
    }


    $('.commentBtn').click(function (e) {
        e.preventDefault();
        var cmtext = $('#cmtext').val();
        var ccid = $('#ccid').val();
        // alert(cmtext);
        if (cmtext.length != '') {
            var data = {
                'cmtext': cmtext,
                'ccid': ccid,
            };
            $.ajax({
                url: 'process/comments.pro.php',
                type: 'post',
                data: data,
                success: function (response) {
                    alert(response);
                    $('#cmtext').val('');
                }
            });
        }
    });

    $('#isCoreSubject').change(function (e) {
        e.preventDefault();

        // var cid = $('#isCoreSubject').val(); // get card id
        var isCoreSubject = $('#isCoreSubject');
        if (isCoreSubject.prop('checked')) {
            $('#cid').val('');
            $('.courseDiv').hide();
        } else {
            $('.courseDiv').show();
        }
    });

    $('#role').change(function (e) {
        e.preventDefault();
        if ($('#role').val() == 'admin') {
            $('#sjid').val('');
        }
    });


})

$(document).ready(function() {
  // Check initial screen size on document load
  if ($(window).width() < 768) {
    $("#sidebarToggler").collapse('hide'); // Hide sidebar on small screens initially
  }

  $(window).resize(function() {
    // Handle resize events to adjust sidebar visibility
    if ($(window).width() < 768) {
      $("#sidebarToggler").collapse('hide'); // Hide on resize to small screens
    } else {
      $("#sidebarToggler").collapse('show'); // Show on resize to larger screens
    }
  });
});

