@php

$hasLocationErrors = $errors->hasAny([
'country',
'state',
'district',
'city'
]);

@endphp


<script>
document.addEventListener('DOMContentLoaded', function() {


   
    const form =
        document.getElementById('projectForm');

    const workMode =
        document.getElementById('work_mode');

    const locationFields =
        document.getElementById('locationFields');


    const hasLocationErrors = {
        {
            $hasLocationErrors ? 'true' : 'false'
        }
    };



    

    function toggleLocation() {

        if (!workMode || !locationFields) {
            return;
        }


        if (
            workMode.value === 'onsite' ||
            workMode.value === 'hybrid' ||
            hasLocationErrors
        ) {

            locationFields.style.display = 'block';

        } else {

            locationFields.style.display = 'none';

        }

    }


    if (workMode) {

        workMode.addEventListener(
            'change',
            toggleLocation
        );

        toggleLocation();

    }



  
    if (form) {

        form.addEventListener(
            'submit',
            function() {

                const submitButton =
                    form.querySelector(
                        'button[type="submit"]'
                    );


                if (submitButton) {

                    submitButton.innerHTML =
                        '<i class="fas fa-spinner fa-spin"></i> Posting Project...';

                    submitButton.disabled = true;

                }

            }
        );

    }



   

    document
        .querySelectorAll(
            '.project-input, .project-select, .project-textarea'
        )
        .forEach(function(input) {

            input.addEventListener(
                'focus',
                function() {

                    this.classList.remove(
                        'is-invalid'
                    );

                }
            );

        });



    

    function attachFilter(
        id,
        pattern,
        message
    ) {

        const input =
            document.getElementById(id);


        if (!input) {
            return;
        }


        input.addEventListener(
            'input',
            function() {

                const original =
                    this.value;


                const filtered =
                    original.replace(
                        pattern,
                        ''
                    );


                if (original !== filtered) {

                    this.value =
                        filtered;

                    this.classList.add(
                        'is-invalid'
                    );


                    let feedback =
                        this.parentNode.parentNode.querySelector(
                            '.js-live-feedback'
                        );


                    if (!feedback) {

                        feedback =
                            document.createElement(
                                'div'
                            );

                        feedback.className =
                            'project-invalid-feedback js-live-feedback';

                        this.parentNode.parentNode.appendChild(
                            feedback
                        );

                    }


                    feedback.textContent =
                        message;

                } else {

                    this.classList.remove(
                        'is-invalid'
                    );


                    const feedback =
                        this.parentNode.parentNode.querySelector(
                            '.js-live-feedback'
                        );


                    if (feedback) {
                        feedback.remove();
                    }

                }

            }
        );

    }



    

    attachFilter(
        'title',
        /[^A-Za-z0-9\s\-&().,]/g,
        'Only letters, numbers, and & ( ) . , - are allowed.'
    );



    attachFilter(
        'budget',
        /[^0-9₹$,.\/\-\s]/g,
        'Only numbers and ₹ $ , . - / are allowed.'
    );



    

    attachFilter(
        'duration',
        /[^A-Za-z0-9\s\-]/g,
        'Only letters, numbers, and - are allowed.'
    );




    attachFilter(
        'skills',
        /[^A-Za-z0-9\s,.\/\-+#]/g,
        'Only letters, numbers, commas, dots, +, #, / and - are allowed.'
    );



    

    attachFilter(
        'country',
        /[^A-Za-z\s]/g,
        'Only letters are allowed.'
    );


    attachFilter(
        'state',
        /[^A-Za-z\s]/g,
        'Only letters are allowed.'
    );


    attachFilter(
        'district',
        /[^A-Za-z\s]/g,
        'Only letters are allowed.'
    );


    attachFilter(
        'city',
        /[^A-Za-z\s]/g,
        'Only letters are allowed.'
    );



    

    const deadline =
        document.getElementById('deadline');


    if (deadline) {

        const today =
            new Date()
            .toISOString()
            .split('T')[0];


        deadline.setAttribute(
            'min',
            today
        );

    }



   

    const projectType =
        document.getElementById('project_type');

    const budget =
        document.getElementById('budget');


    function updateBudgetPlaceholder() {

        if (!projectType || !budget) {
            return;
        }


        if (projectType.value === 'hourly') {

            budget.placeholder =
                'e.g. ₹500/hour';

        } else {

            budget.placeholder =
                'e.g. ₹25,000 - ₹50,000';

        }

    }


    if (projectType) {

        projectType.addEventListener(
            'change',
            updateBudgetPlaceholder
        );

        updateBudgetPlaceholder();

    }

});
</script>