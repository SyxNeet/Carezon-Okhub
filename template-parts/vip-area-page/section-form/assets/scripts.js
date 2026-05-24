export function sectionForm() {
    const forms = document.querySelectorAll(".section-form__form");

    if (!forms.length) return;

    // =========================================================
    // VALIDATORS
    // =========================================================

    const validators = {
        fullName(value) {
            const trimmed = value?.trim() || "";

            if (!trimmed) {
                return "Vui lòng nhập họ và tên";
            }

            if (trimmed.length < 2) {
                return "Họ và tên phải có ít nhất 2 ký tự";
            }

            const regex = /^[\p{L}\s'-]+$/u;

            if (!regex.test(trimmed)) {
                return "Họ và tên không hợp lệ";
            }

            return null;
        },

        phone(value) {
            if (!value?.trim()) {
                return "Vui lòng nhập số điện thoại";
            }

            const cleanPhone = value.replace(/\D/g, "");

            if (cleanPhone.length < 10 || cleanPhone.length > 11) {
                return "Số điện thoại phải có 10-11 chữ số";
            }

            if (!/^(0[3|5|7|8|9])[0-9]{8}$/.test(cleanPhone)) {
                return "Số điện thoại không đúng định dạng Việt Nam";
            }

            return null;
        },

        service(value) {
            if (!value?.trim()) {
                return "Vui lòng chọn dịch vụ";
            }

            return null;
        },

        quantity(adults, children) {
            const total =
                (parseInt(adults) || 0) +
                (parseInt(children) || 0);

            if (total < 1) {
                return "Vui lòng chọn ít nhất 1 người";
            }

            return null;
        },
    };

    // =========================================================
    // HELPERS
    // =========================================================

    const formatNumber = (value) => {
        return String(value).padStart(2, "0");
    };

    function getField(form, name) {
        return form.querySelector(`[name="${name}"]`);
    }

    function getErrorElement(form, name) {
        return form.querySelector(`#${name}Error`);
    }

    function showError(form, fieldName, message) {
        const errorElement = getErrorElement(form, fieldName);

        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.add("show");
        }

        const input = getField(form, fieldName);

        if (input) {
            const wrapper = input.closest(".section-form__field");

            if (wrapper) {
                wrapper.classList.add("error");
            }
        }

        // custom select
        if (fieldName === "service") {
            const selectWrapper = form.querySelector(
                ".section-form__field--select"
            );

            selectWrapper?.classList.add("error");
        }

        // quantity
        if (fieldName === "quantity") {
            const quantityWrapper = form.querySelector(
                ".booking__form__quantity"
            );

            quantityWrapper?.classList.add("error");
        }
    }

    function clearError(form, fieldName) {
        const errorElement = getErrorElement(form, fieldName);

        if (errorElement) {
            errorElement.textContent = "";
            errorElement.classList.remove("show");
        }

        const input = getField(form, fieldName);

        if (input) {
            const wrapper = input.closest(".section-form__field");

            wrapper?.classList.remove("error");
        }

        if (fieldName === "service") {
            form.querySelector(
                ".section-form__field--select"
            )?.classList.remove("error");
        }

        if (fieldName === "quantity") {
            form.querySelector(
                ".booking__form__quantity"
            )?.classList.remove("error");
        }
    }

    // =========================================================
    // SELECT
    // =========================================================

    function initSelect(form) {
        const select = form.querySelector(".section-form__field--select");

        if (!select) return;

        const trigger = select.querySelector(
            ".section-form__select-trigger"
        );

        const placeholder = select.querySelector(
            ".section-form__select-placeholder"
        );

        const optionsWrapper = select.querySelector(
            ".section-form__select-options"
        );

        const options = select.querySelectorAll(
            ".section-form__select-option"
        );

        // create hidden input
        let hiddenInput = form.querySelector('[name="service"]');

        if (!hiddenInput) {
            hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "service";

            form.appendChild(hiddenInput);
        }

        // toggle
        trigger.addEventListener("click", (e) => {
            e.stopPropagation();

            document
                .querySelectorAll(
                    ".section-form__select-options.active"
                )
                .forEach((item) => {
                    if (item !== optionsWrapper) {
                        item.classList.remove("active");
                    }
                });

            optionsWrapper.classList.toggle("active");

            select.classList.toggle(
                "is-active",
                optionsWrapper.classList.contains("active")
            );
        });

        // select option
        options.forEach((option) => {
            option.addEventListener("click", () => {
                options.forEach((item) => {
                    item.classList.remove("selected");
                });

                option.classList.add("selected");

                const value = option.textContent.trim();

                placeholder.textContent = value;
                placeholder.classList.add("is-selected");

                hiddenInput.value = value;

                clearError(form, "service");

                optionsWrapper.classList.remove("active");
                select.classList.remove("is-active");
            });
        });
    }

    // =========================================================
    // QUANTITY
    // =========================================================

    function initQuantity(form) {
        const controls = form.querySelectorAll(
            ".section-form__quantity-control"
        );

        controls.forEach((control) => {
            const buttons = control.querySelectorAll(
                ".section-form__quantity-button"
            );

            const input = control.querySelector(
                ".section-form__quantity-input"
            );

            if (!buttons.length || !input) return;

            const minusButton = buttons[0];
            const plusButton = buttons[1];

            const min = parseInt(input.min) || 0;
            const max = parseInt(input.max) || 20;

            minusButton.addEventListener("click", () => {
                let value = parseInt(input.value) || 0;

                value--;

                if (value < min) {
                    value = min;
                }

                input.value = formatNumber(value);

                clearError(form, "quantity");
            });

            plusButton.addEventListener("click", () => {
                let value = parseInt(input.value) || 0;

                value++;

                if (value > max) {
                    value = max;
                }

                input.value = formatNumber(value);

                clearError(form, "quantity");
            });

            input.addEventListener("input", () => {
                let value = input.value.replace(/\D/g, "");

                value = parseInt(value) || 0;

                if (value < min) value = min;
                if (value > max) value = max;

                input.value = formatNumber(value);

                clearError(form, "quantity");
            });

            input.addEventListener("keydown", (e) => {
                if (
                    e.key === "-" ||
                    e.key === "+" ||
                    e.key === "e"
                ) {
                    e.preventDefault();
                }
            });
        });
    }

    // =========================================================
    // VALIDATE
    // =========================================================

    function validateForm(form) {
        let isValid = true;

        const fullName =
            getField(form, "fullName")?.value || "";

        const phone =
            getField(form, "phone")?.value || "";

        const service =
            getField(form, "service")?.value || "";

        const adults =
            getField(form, "adults")?.value || 0;

        const children =
            getField(form, "children")?.value || 0;

        // fullName
        const fullNameError =
            validators.fullName(fullName);

        if (fullNameError) {
            showError(form, "fullName", fullNameError);
            isValid = false;
        } else {
            clearError(form, "fullName");
        }

        // phone
        const phoneError = validators.phone(phone);

        if (phoneError) {
            showError(form, "phone", phoneError);
            isValid = false;
        } else {
            clearError(form, "phone");
        }

        // service
        const serviceError =
            validators.service(service);

        if (serviceError) {
            showError(form, "service", serviceError);
            isValid = false;
        } else {
            clearError(form, "service");
        }

        // quantity
        const quantityError =
            validators.quantity(adults, children);

        if (quantityError) {
            showError(form, "quantity", quantityError);
            isValid = false;
        } else {
            clearError(form, "quantity");
        }

        return isValid;
    }

    // =========================================================
    // FORM DATA
    // =========================================================

    function getFormData(form) {
        const formData = new FormData(form);

        const phone =
            getField(form, "phone")?.value || "";

        formData.set(
            "phone",
            phone.replace(/\D/g, "")
        );

        formData.append(
            "timestamp",
            new Date().toISOString()
        );

        return formData;
    }

    // =========================================================
    // RESET
    // =========================================================

    function resetForm(form) {
        form.reset();

        // reset select
        const placeholder = form.querySelector(
            ".section-form__select-placeholder"
        );

        if (placeholder) {
            placeholder.textContent =
                "Chọn dịch vụ tại Carezone";

            placeholder.classList.remove("is-selected");
        }

        form.querySelectorAll(
            ".section-form__select-option"
        ).forEach((option) => {
            option.classList.remove("selected");
        });

        form.querySelector(
            ".section-form__field--select"
        )?.classList.remove(
            "is-active",
            "error"
        );
        
        const hiddenService = form.querySelector('[name="service"]');
            if (hiddenService) {
            hiddenService.value = "";
        }

        // reset quantity
        form.querySelectorAll(
            ".section-form__quantity-input"
        ).forEach((input) => {
            input.value = "01";
        });

        // clear errors
        [
            "fullName",
            "phone",
            "service",
            "quantity",
        ].forEach((field) => {
            clearError(form, field);
        });
    }

    // =========================================================
    // SUBMIT
    // =========================================================

    async function submitForm(form) {
        if (!validateForm(form)) return;

        const submitButton = form.querySelector(
            ".section-form__button"
        );

        const buttonText = submitButton?.querySelector(
            ".section-form__button-text"
        );

        try {
            submitButton.disabled = true;

            if (buttonText) {
                buttonText.textContent = "Đang xử lý...";
            }

            const formData = getFormData(form);

            console.log(
                "Form data:",
                Object.fromEntries(formData.entries())
            );

            const cf7Request = new CF7Request(formData);

            const response = await cf7Request.send({
                id: 5,
                unitTag: "34242ca",
            });

            console.log("CF7 Response:", response);

            // =====================================================
            // VALIDATION FAILED
            // =====================================================

            if (response.status === "validation_failed") {

                response.invalid_fields?.forEach((field) => {
                    const fieldName = field.field;

                    let errorField = fieldName;

                    // map CF7 field -> local field
                    if (fieldName === "service") {
                        errorField = "service";
                    }

                    showError(
                        form,
                        errorField,
                        field.message
                    );
                });

                if (typeof toastNotification !== "undefined") {
                    toastNotification.error(
                        "Thông tin chưa hợp lệ!",
                        "Vui lòng kiểm tra lại các trường bắt buộc.",
                        6000
                    );
                }

                return;
            }

            // =====================================================
            // MAIL FAILED
            // =====================================================

            if (response.status === "mail_failed") {
                throw new Error(
                    response.message ||
                    "Không thể gửi email."
                );
            }

            // =====================================================
            // SPAM
            // =====================================================

            if (response.status === "spam") {
                throw new Error(
                    "Hệ thống phát hiện spam."
                );
            }

            // =====================================================
            // SUCCESS
            // =====================================================

            if (response.status === "mail_sent") {

                if (
                    typeof toastNotification !==
                    "undefined"
                ) {
                    toastNotification.success(
                        "Đặt chỗ thành công!",
                        "Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ sớm nhất.",
                        6000
                    );
                }

                resetForm(form);

                return;
            }

            // =====================================================
            // UNKNOWN ERROR
            // =====================================================

            throw new Error(
                response.message ||
                "Có lỗi xảy ra khi gửi form."
            );

        } catch (error) {
            console.error(error);

            if (typeof toastNotification !== "undefined") {
                toastNotification.error(
                    "Gửi thông tin thất bại!",
                    error?.message ||
                    "Có lỗi xảy ra khi gửi thông tin. Vui lòng thử lại.",
                    6000
                );
            }

        } finally {
            submitButton.disabled = false;

            if (buttonText) {
                buttonText.textContent =
                    "Đặt chỗ ngay";
            }
        }
    }

    // =========================================================
    // REALTIME VALIDATION
    // =========================================================

    function bindRealtimeValidation(form) {
        const fullNameInput =
            getField(form, "fullName");

        const phoneInput =
            getField(form, "phone");

        // helper
        const setupInputValidation = (
            input,
            validator,
            fieldName
        ) => {
            if (!input) return;

            // validate on blur
            input.addEventListener("blur", () => {
                const error = validator(input.value);

                if (error) {
                    showError(
                        form,
                        fieldName,
                        error
                    );
                } else {
                    clearError(
                        form,
                        fieldName
                    );
                }
            });

            // clear error on input
            input.addEventListener("input", () => {
                if (
                    input.value.trim().length > 0
                ) {
                    clearError(
                        form,
                        fieldName
                    );
                }
            });
        };

        // setup validations
        setupInputValidation(
            fullNameInput,
            validators.fullName,
            "fullName"
        );

        setupInputValidation(
            phoneInput,
            validators.phone,
            "phone"
        );
    }

    // =========================================================
    // INIT FORM
    // =========================================================

    function initForm(form) {
        initSelect(form);

        initQuantity(form);

        bindRealtimeValidation(form);

        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            await submitForm(form);
        });
    }

    // =========================================================
    // CLICK OUTSIDE
    // =========================================================

    document.addEventListener("click", () => {
        document
            .querySelectorAll(
                ".section-form__select-options.active"
            )
            .forEach((item) => {
                item.classList.remove("active");
            });

        document
            .querySelectorAll(
                ".section-form__field--select.is-active"
            )
            .forEach((item) => {
                item.classList.remove("is-active");
            });
    });

    // =========================================================
    // INIT
    // =========================================================

    forms.forEach(initForm);
}