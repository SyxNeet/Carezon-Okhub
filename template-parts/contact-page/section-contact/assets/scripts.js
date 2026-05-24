export function sectionContact() {
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
    const nameRegex = /^[\p{L}\s'-]+$/u;

    if (!nameRegex.test(trimmedName)) {
      return "Họ và tên chỉ được chứa chữ cái và khoảng trắng";
    }

    return null; // No error
  }

  function validatePhone(phone) {
    if (!phone || phone.trim().length === 0) {
      return "Vui lòng nhập số điện thoại";
    }

    const cleanPhone = phone.replace(/\D/g, "");
    if (cleanPhone.length < 10 || cleanPhone.length > 11) {
      return "Số điện thoại phải có 10-11 chữ số";
    }

    if (!/^(0[3|5|7|8|9])[0-9]{8}$/.test(cleanPhone)) {
      return "Số điện thoại không đúng định dạng Việt Nam";
    }

    return null;
  }

  function validateEmail(email) {
    if (!email || email.trim().length === 0) {
      return "Vui lòng nhập email";
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.trim())) {
      return "Email không đúng định dạng";
    }

    return null;
  }

  function validateMessage(message) {
    // Message is optional, so no validation needed
    return null;
  }

  // ------------------------------------------------------------
  // Error handling helpers
  function showError(fieldName, message, form) {
    const errorElement = form.querySelector(`#${fieldName}Error`);
    const inputElement = form.querySelector(`[name="${fieldName}"]`);
    const fieldWrapper =
      inputElement?.closest(".contact__field") ||
      inputElement?.closest(".form-field");

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
    const fieldWrapper =
      inputElement?.closest(".contact__field") ||
      inputElement?.closest(".form-field");

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

    const fullName = form.querySelector('[name="fullName"]')?.value || "";
    const phone = form.querySelector('[name="phone"]')?.value || "";
    const email = form.querySelector('[name="email"]')?.value || "";
    const message = form.querySelector('[name="message"]')?.value || "";

    // Clear all errors first
    clearError("fullName", form);
    clearError("phone", form);
    clearError("email", form);
    clearError("message", form);

    // Validate fields
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

    const emailError = validateEmail(email);
    if (emailError) {
      showError("email", emailError, form);
      isValid = false;
    }

    return isValid;
  }

  // ------------------------------------------------------------
  // Helpers
  function getFormData(form) {
    return {
      fullName: form.querySelector('[name="fullName"]')?.value.trim() || "",
      phone: (form.querySelector('[name="phone"]')?.value || "").replace(
        /\D/g,
        ""
      ),
      email: form.querySelector('[name="email"]')?.value.trim() || "",
      message: form.querySelector('[name="message"]')?.value.trim() || "",
      timestamp: new Date().toISOString(),
    };
  }

  function resetForm(form) {
    form.reset();
    // Clear any remaining error states
    ["fullName", "phone", "email", "message"].forEach((field) => {
      clearError(field, form);
    });
  }

  // ------------------------------------------------------------
  // Main form initialization
  function initFormValidation() {
    const forms = document.querySelectorAll("#contactForm, .contact-form");

    forms.forEach((form, formIndex) => {
      const submitButton = form.querySelector(
        ".contact__submit-btn, .submit-btn"
      );
      const submitButtonText = submitButton?.querySelector(
        ".contact__submit-btn-text, .submit-btn-text"
      );

      form.addEventListener("submit", (e) => {
        e.preventDefault();

        if (validateForm(form)) {
          submitButton.disabled = true;
          if (submitButtonText) {
            submitButtonText.textContent = "Đang xử lý...";
          }

          const formData = getFormData(form);
          console.log(`Form ${formIndex + 1} data ready for API:`, formData);

          const cf7Request = new CF7Request(formData);
          cf7Request
            .send({
              id: 589,
              unitTag: "7633dfa",
            })
            .then((response) => {
              console.log(`Form ${formIndex + 1} CF7 Success:`, response);
              if (typeof toastNotification !== "undefined") {
                toastNotification.success(
                  "Gửi thông tin thành công!",
                  "Cảm ơn bạn đã liên hệ với Carezone. Chúng tôi sẽ phản hồi sớm nhất có thể.",
                  6000
                );
              }
              resetForm(form);
            })
            .catch((error) => {
              console.error(`Form ${formIndex + 1} CF7 Error:`, error);
              if (typeof toastNotification !== "undefined") {
                toastNotification.error(
                  "Gửi thông tin thất bại!",
                  "Có lỗi xảy ra khi gửi thông tin. Vui lòng kiểm tra lại và thử lại.",
                  6000
                );
              }
            })
            .finally(() => {
              submitButton.disabled = false;
              if (submitButtonText) {
                submitButtonText.textContent = "Gửi thông tin";
              }
            });
        }
      });

      // Real-time validation bindings
      const fullNameInput = form.querySelector('[name="fullName"]');
      const phoneInput = form.querySelector('[name="phone"]');
      const emailInput = form.querySelector('[name="email"]');
      const messageInput = form.querySelector('[name="message"]');

      // Helper function to handle input validation
      const setupInputValidation = (input, validator, fieldName) => {
        if (!input) return;

        // Validate on blur
        input.addEventListener("blur", () => {
          const error = validator(input.value);
          if (error) {
            showError(fieldName, error, form);
          } else {
            clearError(fieldName, form);
          }
        });

        // Clear error on input
        input.addEventListener("input", () => {
          if (input.value.trim().length > 0) {
            clearError(fieldName, form);
          }
        });
      };

      // Set up validation for each field
      setupInputValidation(fullNameInput, validateFullName, "fullName");
      setupInputValidation(phoneInput, validatePhone, "phone");
      setupInputValidation(emailInput, validateEmail, "email");

      // Message is optional, just clear errors on input
      if (messageInput) {
        messageInput.addEventListener("input", () => {
          clearError("message", form);
        });
      }
    });
  }

  // ------------------------------------------------------------
  // Initialize contact form
  initFormValidation();
}
