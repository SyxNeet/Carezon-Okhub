export function sectionBooking() {
    // ------------------------------------------------------------
    // Quantity counter (for multiple forms)
    function initQuantityCounters() {
        const plusButtons = document.querySelectorAll(
            ".booking__form-option-quantity__control-icon"
        );

        plusButtons.forEach((button) => {
            button.addEventListener("click", function() {
                const input = this.parentElement.querySelector(
                    ".booking__form-option-quantity__control-input"
                );
                const currentValue = parseInt(input.value) || 0;
                const isPlusButton = this.querySelector('img[src*="icon-plus"]');

                if (isPlusButton) {
                    input.value = formatNumber(currentValue + 1);
                } else {
                    if (currentValue > 0) {
                        input.value = formatNumber(currentValue - 1);
                    }
                }
            });
        });
    }

    // ------------------------------------------------------------
    // Utility: number formatting
    function formatNumber(num) {
        return num.toString().padStart(2, "0");
    }

    // ------------------------------------------------------------
    // Validation rules
    function validateFullName(name) {
        // First, trim the input
        const trimmedName = name ? name.trim() : "";

        // Check if empty
        if (!trimmedName) {
            return "Vui lòng nhập họ và tên";
        }

        // Check minimum length
        if (trimmedName.length < 2) {
            return "Họ và tên phải có ít nhất 2 ký tự";
        }

        // Check for valid Vietnamese characters, spaces, and common name separators
        // This pattern is more permissive and handles most Vietnamese names
        const nameRegex = /^[\p{L}\s'-]+$/u;

        if (!nameRegex.test(trimmedName)) {
            console.log("Invalid name format:", trimmedName);
            return "Họ và tên chỉ được chứa chữ cái và khoảng trắng";
        }

        return null; // No error
    }

    function validatePhone(phone) {
        if (!phone || phone.trim().length === 0)
            return "Vui lòng nhập số điện thoại";

        const cleanPhone = phone.replace(/\D/g, "");
        if (cleanPhone.length < 10 || cleanPhone.length > 11)
            return "Số điện thoại phải có 10-11 chữ số";

        if (!/^(0[3|5|7|8|9])[0-9]{8}$/.test(cleanPhone))
            return "Số điện thoại không đúng định dạng Việt Nam";

        return null;
    }

    function validateService(serviceValue) {
        if (!serviceValue || serviceValue === "Chọn dịch vụ tại Carezone")
            return "Vui lòng chọn dịch vụ";
        return null;
    }

    function validateQuantity(adults, children) {
        const adultCount = parseInt(adults) || 0;
        const childCount = parseInt(children) || 0;

        if (adultCount < 0 || childCount < 0) return "Số lượng không được âm";
        if (adultCount > 20 || childCount > 20)
            return "Số lượng tối đa là 20 người mỗi loại";
        if (adultCount === 0 && childCount === 0)
            return "Vui lòng chọn ít nhất 1 người";

        return null;
    }

    // ------------------------------------------------------------
    // Error handling helpers
    function showError(fieldName, message, form) {
        const errorElement = form.querySelector(`#${fieldName}Error`);
        const inputElement = form.querySelector(`[name="${fieldName}"]`);
        const fieldWrapper = inputElement?.closest(".contact__field");

        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.add("show");
        }

        if (fieldWrapper) {
            fieldWrapper.classList.add("error");
        }
    }

    function clearError(fieldName, form) {
        const errorElement = form.querySelector(`#${fieldName}Error`);
        const inputElement = form.querySelector(`[name="${fieldName}"]`);
        const fieldWrapper = inputElement?.closest(".contact__field");

        if (errorElement) {
            errorElement.textContent = "";
            errorElement.classList.remove("show");
        }

        if (fieldWrapper) {
            fieldWrapper.classList.remove("error");
        }
    }

    // ------------------------------------------------------------
    // Form validation entrypoint
    function validateForm(form) {
        let isValid = true;

        const fullName = form.querySelector('[name="fullName"]').value;
        const phone = form.querySelector('[name="phone"]').value;
        const serviceValue = form.querySelector(
            ".custom-select__value"
        ).textContent;
        const adults = form.querySelector('[name="adults"]').value;
        const children = form.querySelector('[name="children"]').value;

        clearError("fullName", form);
        clearError("phone", form);
        clearError("service", form);
        clearError("adults", form);
        clearError("children", form);

        const fullNameError = validateFullName(fullName);
        if (fullNameError) {
            showError("fullName", fullNameError, form);
            isValid = false;
        }

        const phoneError = validatePhone(phone);
        if (phoneError) {
            showError("phone", phoneError, form);
            isValid = false;
        }

        const serviceError = validateService(serviceValue);
        if (serviceError) {
            showError("service", serviceError, form);
            isValid = false;
        }

        const quantityError = validateQuantity(adults, children);
        if (quantityError) {
            showError("adults", quantityError, form);
            showError("children", quantityError, form);
            isValid = false;
        }

        return isValid;
    }

    // ------------------------------------------------------------
    // Helpers
    function getFormData(form) {
        const message = form.querySelector('[name="message"]') ?
            form.querySelector('[name="message"]').value :
            "";

        return {
            fullName: form.querySelector('[name="fullName"]').value.trim(),
            phone: form.querySelector('[name="phone"]').value.replace(/\D/g, ""),
            service: form.querySelector(".custom-select__value").textContent,
            adults: parseInt(form.querySelector('[name="adults"]').value) || 0,
            children: parseInt(form.querySelector('[name="children"]').value) || 0,
            message: message,
            timestamp: new Date().toISOString(),
        };
    }

    function resetForm(form) {
        form.reset();
        const customSelectValue = form.querySelector(".custom-select__value");
        if (customSelectValue) {
            customSelectValue.textContent = "Chọn dịch vụ tại Carezone";
        }
        form
            .querySelectorAll(".custom-select__option")
            .forEach((opt) => opt.classList.remove("selected"));
    }

    // ------------------------------------------------------------
    // Custom select logic (multi-form safe)
    function initCustomSelects() {
        const customSelects = document.querySelectorAll(".custom-select");

        customSelects.forEach((select) => {
            const trigger = select.querySelector(".custom-select__trigger");
            const options = select.querySelector(".custom-select__options");
            const value = select.querySelector(".custom-select__value");
            const optionItems = select.querySelectorAll(".custom-select__option");

            trigger.addEventListener("click", (e) => {
                e.stopPropagation();
                const isActive = trigger.classList.contains("active");

                customSelects.forEach((otherSelect) => {
                    if (otherSelect !== select) {
                        otherSelect
                            .querySelector(".custom-select__trigger")
                            ?.classList.remove("active");
                        otherSelect
                            .querySelector(".custom-select__options")
                            ?.classList.remove("active");
                    }
                });

                trigger.classList.toggle("active");
                options.classList.toggle("active");
            });

            optionItems.forEach((option) => {
                option.addEventListener("click", (e) => {
                    e.stopPropagation();
                    value.textContent = option.textContent;
                    optionItems.forEach((opt) => opt.classList.remove("selected"));
                    option.classList.add("selected");
                    trigger.classList.remove("active");
                    options.classList.remove("active");

                    const changeEvent = new Event("change", {
                        bubbles: true
                    });
                    select.dispatchEvent(changeEvent);
                });
            });

            document.addEventListener("click", (e) => {
                if (!select.contains(e.target)) {
                    trigger.classList.remove("active");
                    options.classList.remove("active");
                }
            });
        });
    }

    // ------------------------------------------------------------
    // Main form initialization
    function initFormValidation() {
        const forms = document.querySelectorAll(".booking__form");

        forms.forEach((form, formIndex) => {
            const submitButton = form.querySelector(".booking__form-option-button");

            form.addEventListener("submit", (e) => {
                e.preventDefault();

                if (validateForm(form)) {
                    submitButton.disabled = true;
                    submitButton.querySelector(
                        ".booking__form-option-button-text"
                    ).textContent = "Đang xử lý...";

                    const formData = getFormData(form);
                    console.log(`Form ${formIndex + 1} data ready for API:`, formData);

                    const cf7Request = new CF7Request(formData);
                    cf7Request
                        .send({
                            id: 5,
                            unitTag: "34242ca"
                        })
                        .then((response) => {
                            console.log(`Form ${formIndex + 1} CF7 Success:`, response);
                            toastNotification.success(
                                "Đặt chỗ thành công!",
                                "Cảm ơn bạn đã đặt chỗ tại Carezone. Chúng tôi sẽ liên hệ lại sớm nhất có thể.",
                                6000
                            );
                            resetForm(form);
                        })
                        .catch((error) => {
                            console.error(`Form ${formIndex + 1} CF7 Error:`, error);
                            toastNotification.error(
                                "Đặt chỗ thất bại!",
                                "Có lỗi xảy ra khi đặt chỗ. Vui lòng kiểm tra lại thông tin và thử lại.",
                                6000
                            );
                        })
                        .finally(() => {
                            submitButton.disabled = false;
                            submitButton.querySelector(
                                ".booking__form-option-button-text"
                            ).textContent = "Đặt chỗ ngay";
                        });
                }
            });

            // Real-time validation bindings
            const fullNameInput = form.querySelector('[name="fullName"]');
            const phoneInput = form.querySelector('[name="phone"]');
            const adultsInput = form.querySelector('[name="adults"]');
            const childrenInput = form.querySelector('[name="children"]');
            const serviceSelect = form.querySelector(".custom-select");

            if (fullNameInput)
                fullNameInput.addEventListener("blur", () => {
                    const error = validateFullName(fullNameInput.value);
                    error
                        ?
                        showError("fullName", error, form) :
                        clearError("fullName", form);
                });

            if (phoneInput)
                phoneInput.addEventListener("blur", () => {
                    const error = validatePhone(phoneInput.value);
                    error ? showError("phone", error, form) : clearError("phone", form);
                });

            const validateQuantities = () => {
                const error = validateQuantity(
                    adultsInput?.value,
                    childrenInput?.value
                );
                if (error) {
                    showError("adults", error, form);
                    showError("children", error, form);
                } else {
                    clearError("adults", form);
                    clearError("children", form);
                }
            };

            adultsInput?.addEventListener("change", validateQuantities);
            childrenInput?.addEventListener("change", validateQuantities);

            if (serviceSelect) {
                serviceSelect.addEventListener("change", () => {
                    const serviceValue = form.querySelector(
                        ".custom-select__value"
                    ).textContent;
                    const error = validateService(serviceValue);
                    error
                        ?
                        showError("service", error, form) :
                        clearError("service", form);
                });
            }
        });
    }

    // ------------------------------------------------------------
    // Initialize all booking features
    initQuantityCounters();
    initCustomSelects();
    initFormValidation();
}