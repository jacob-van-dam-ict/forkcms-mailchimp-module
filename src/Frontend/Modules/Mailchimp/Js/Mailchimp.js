/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * Interaction for the mailchimp module
 *
 * @author John Poelman <john.poelman@bloobz.be>
 */
jsFrontend.Mailchimp =
{
    // constructor
    init: function() {
        $('.resultMessage').hide();
        jsFrontend.Mailchimp.ajax();
    },

ajax: function() {


    $('#mailchimpSubscribe').click(
        function () {

            // vars
            var subscriber = $('#subscriber').val();

            $.ajax
            ({
                data: {
                    fork: {module: 'mailchimp', action: 'Subscription'},
                    subscriber: subscriber
                },

                success: function (data) {
                    // alert the user of we're in debug mode and
                    if (data.code != 200 && jsFrontend.debug) {
                        alert(data.message);
                    }
                    else {
                        // show the success modal
                        $('.resultMessage').show();
                    }
                }
            });

            // return
            return false;
        }
    );
},

eoo: true
}

jsFrontend.Mailchimp.init();