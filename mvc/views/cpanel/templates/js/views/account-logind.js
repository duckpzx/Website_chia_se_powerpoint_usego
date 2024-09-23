// btn Submit 
const btnLogind = $('#btn-logind');

let submitPreventDefault = true;

btnLogind.disabled = true;

// Effect loading when sender email 
const loadingTopEmail = $('.loading-effect-top');
const loadingMain  = $('.loading-ss');

const formElements = {
    email: $("input[name='email']"),
    emailForgot: $("input[name='emailForgot']"),
    password: $("input[name='password']"),
    passwordForgot: $("input[name='passwordForgot']"),
    otpForgot: $("input[name='otpForgot']"),
}

// variable tracking
const fieldCompletionStatus = {
    email: false,
    emailForgot: false,
    password: false,
    passwordForgot: false,
    otpForgot: false,
};

// Object to store error messages
const errorMessages = {
    email: {},
    emailForgot: {},
    password: {},
    passwordForgot: {},
    otpForgot: {},
};

const contentMessage = {
    email: {
        empty: 'Trường này đang để trống!',
        invalid: 'Email của bạn không hợp lệ',
    },
    emailForgot: {
        empty: 'Trường này đang để trống!',
        invalid: 'Email của bạn không hợp lệ',
    },
    password: {
        empty: 'Trường này đang để trống!',
        invalid: 'Mật khẩu của bạn không hợp lệ',
    },
    passwordForgot: {
        empty: 'Trường này đang để trống!',
        invalid: 'Mật khẩu của bạn không hợp lệ',
    },
    otpForgot: {
        empty: 'Trường này đang để trống!',
    }
};

const formValues = {};

function onLoading() {
    TypeClass.class('add', loadingMain, 'loading');
}

function offLoading() {
    TypeClass.class('remove', loadingMain, 'loading');
}

// Remove border when no errors
function removeBorderError() {
    const inputInFormControl = $$('.form-control .on-interact');
    inputInFormControl.forEach((element) => {
        element.style.border = '1.5px solid rgba(22,24,35,.06)';
    })
}

function handleFieldValidation(field, name, value, validationType) {
    const errorMessage = errorMessages[name];
    switch (validationType) {
        case 'email':
            if (isEmpty.check(value)) {
                errorMessage['empty'] = contentMessage.email.empty;
                Messsage.show(field, errorMessage['empty']);
                borderError.create();
            } else if (!isEmailValid.check(value)) {
                errorMessage['invalid'] = contentMessage.email.invalid;
                Messsage.show($(`input[name='${name}']`), errorMessage['invalid']);
                borderError.create();
            } else {
                delete errorMessage['empty'];
                delete errorMessage['invalid'];
                Messsage.remove(field);
                borderError.remove();
            }
            break;

        case 'password':
            if (isEmpty.check(value)) {
                errorMessage['empty'] = contentMessage.password.empty;
                Messsage.show(field, errorMessage['empty']);
                borderError.create();
            } else if (!isPasswordValid.check(value)) {
                errorMessage['invalid'] = contentMessage.password.invalid;
                Messsage.show($(`input[name='${name}']`), errorMessage['invalid']);
                borderError.create();
            } else {
                delete errorMessage['empty'];
                delete errorMessage['invalid'];
                Messsage.remove(field);
                borderError.remove();
            }
            break;

        case 'otp':
            if (isEmpty.check(value)) {
                errorMessage['empty'] = contentMessage.otpForgot.empty;
                Messsage.show(field, errorMessage['empty']);
                borderError.create();
            } else {
                delete errorMessage['empty'];
                Messsage.remove(field);
                borderError.remove();
            }
            break;
    }
    
    // Update field completion status and form values
    fieldCompletionStatus[name] = !isEmpty.check(value);
    formValues[name] = value;
}

function determineValidationType(fieldName) {
    // Add logic here to determine the validation type based on field name
    // For example:
    switch (fieldName) {
        case 'emailForgot':
        case 'email':
            return 'email';
        case 'password':
            return 'password';
        case 'otpForgot':
            return 'otp';
        // Add more cases as needed
        default:
            return null;
    }
}

const inputEmail = $("input[name='email']");
const inputPassword = $("input[name='password']");

function checkInfoBeforeLogind() {
    const valueEmailPresent = inputEmail.value;
    const valuePassPresent = inputPassword.value;
    
    if (valueEmailPresent !== '' && valuePassPresent !== '') {
        btnLogind.disabled = false;
        TypeClass.class('add', btnLogind, 'on');
    } else {
        btnLogind.disabled = true;
        TypeClass.class('remove', btnLogind, 'on');
    }
}

let debounceTimeout;

function debounce(func, delay) {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(func, delay);
}

function checkInfomationDatabase() {
    const data = {
        'email': formValues['email'],
        'password' : btoa(formValues['password']),
        'class': 'checklogin'
    };

    CallAjax.send('POST', data, 'mvc/core/HandleDataLogind.php', function(response) {
        console.log(response);
        try {
            const dataJson = CallAjax.get(response);
            offLoading();
            window.location.href = document.referrer;
        }
        catch (error) { console.error(error) }
    })
}

const logindJavaScript = {
    handleEvents: () => {
        document.addEventListener('DOMContentLoaded', () => {
            // Check input before logind
            for (const fieldName in formElements) {
                const field = formElements[fieldName];
                if (field) {
                    field.addEventListener('blur', () => {
                        const value = field.value.trim();
                        const name = field.getAttribute('name');
                        const validationType = determineValidationType(name);
                        handleFieldValidation(field, name, value, validationType);
                    });
                }
            }    
            
            // Check email
            inputEmail.addEventListener('input', () => {
                debounce(() => {
                    checkInfoBeforeLogind();
                }, 250); 
            });
            
            // Check password
            inputPassword.addEventListener('input', () => {
                debounce(() => {
                    checkInfoBeforeLogind();
                }, 250); 
            });

            // Check logind
            btnLogind.addEventListener('click', function(event) {
                event.preventDefault(); 
                onLoading();
                checkInfomationDatabase();
            });

        });
    },

    start: () => {
        logindJavaScript.handleEvents();
    }
};

logindJavaScript.start();