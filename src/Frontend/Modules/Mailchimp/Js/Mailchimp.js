/**
 * Interaction for the mailchimp module
 *
 * @author John Poelman <john.poelman@bloobz.be>
 * @author Jacob van Dam <j.vandam@jvdict.nl>
 */
jsFrontend.Mailchimp = {
  // constructor
  init: function () {
    jsFrontend.Mailchimp.ajax()
  },

  ajax: function () {
    $('#mailchimpSubscribe').click(function (e) {
        e.preventDefault()

        // vars
        var data = {
            fork: {module: 'Mailchimp', action: 'Subscription'}
          },
          widget = $('#mailchimpSubribeWidget')

        widget.find('input').each(function () {
          data[$(this).attr('name')] = $(this).val()
        })

        widget.find('.has-error').removeClass('has-error')
        widget.find('.error').remove()

        $.ajax({
          data: data,
          error: function (response) {
            $.each(response.responseJSON.data.errors, function (name, errors) {
              var field = $('#subscribe_' + name)

              field.addClass('has-error')
              field.parent().addClass('has-error')

              $.each(errors, function (key, error) {
                field.after($('<span>').addClass('error').html(error))
              })
            })
          },
          success: function (response) {
            widget.find('form').replaceWith($('<p>').html(response.data.message))
          }
        })
      }
    )
  },
  eoo: true
}

jsFrontend.Mailchimp.init()
