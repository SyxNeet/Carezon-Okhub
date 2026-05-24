function remToPixels(rem) {
	return (
		rem * parseFloat(getComputedStyle(document.documentElement).fontSize)
	);
}

class CF7Request {
	#formData;
	constructor(formData) {
		if (formData instanceof FormData) {
			this.#formData = formData;
		} else {
			this.#formData = new FormData();
			Object.entries(formData).forEach(([key, value]) => {
				this.#formData.append(key, value);
			});
		}
	}

#getEndpoint(id) {
const baseUrl = "/wp-json/contact-form-7/v1/contact-forms";
if (!baseUrl) {
	throw new Error(
		"API base URL is not defined in environment variables."
	);
}
return `${baseUrl}/${id}/feedback`;
}

async send({ id, unitTag }) {
	if (!id || !unitTag) {
		throw new Error("Both 'id' and 'unitTag' are required.");
	}

	try {
		this.#formData.append("_wpcf7_unit_tag", unitTag); // Đảm bảo `_wpcf7_unit_tag` được thêm vào
		const response = await fetch(this.#getEndpoint(id), {
									 method: "POST",
									 body: this.#formData,
									 });

		if (!response.ok) {
			throw new Error(`HTTP error! status: ${response.status}`);
		}

		return await response.json();
	} catch (error) {
		console.error("Error sending CF7 request:", error);
		throw error;
	}
}
}

class FormValidator {
	constructor(formSelector, constraints, onSuccess) {
		this.form = document.querySelector(formSelector);
		this.constraints = constraints;
		this.onSuccess = onSuccess;

		if (!this.form) {
			console.error(`Form với selector '${formSelector}' không tồn tại!`);
			return;
		}

		this.attachEventListeners();
	}

	attachEventListeners() {
		this.form.addEventListener("submit", (event) => {
			event.preventDefault();
			this.validateForm();
		});

		const inputs = this.form.querySelectorAll("input, textarea, select");
		inputs.forEach((input) => {
			if (input.hasAttribute("datepicker")) {
				input.addEventListener("changeDate", () =>
									   this.validateInput(input)
									  );
			} else {
				input.addEventListener("input", () =>
									   this.validateInput(input)
									  );
			}
		});
	}

	// Lấy dữ liệu form thành object để truyền vào validate.js
	getFormData() {
		const data = {};
		const elements = this.form.querySelectorAll("[name]");
		elements.forEach((el) => {
			if (el.type === "checkbox") {
				data[el.name] = el.checked ? el.value : "";
			} else if (el.type === "radio") {
				if (el.checked) data[el.name] = el.value;
			} else {
				data[el.name] = el.value;
			}
		});
		return data;
	}

	validateForm(cb) {
		const formData = this.getFormData();
		const errors = validate(formData, this.constraints);
		this.showErrors(errors || {});
		if (!errors) this.handleSuccess();
		if (typeof cb === "function") {
			cb({
				status: !errors, // true nếu không có lỗi
				errors: errors || null,
				formData: formData,
			});
		}
	}

	validateInput(input) {
		const formGroup = this.closestParent(input, "form-group");
		if (!formGroup) return;

		this.resetFormGroup(formGroup);

		const data = this.getFormData();
		const fieldConstraint = { [input.name]: this.constraints[input.name] };
		const errors = validate(data, fieldConstraint);

		if (errors && errors[input.name]) {
			const messages = errors[input.name].map((msg) =>
													this.convertAndRemove(input.name, msg)
												   );
			this.showErrorsForInput(input, messages);
		}
	}

	showErrors(errors) {
		const inputs = this.form.querySelectorAll(
			"input[name], select[name], textarea[name]"
		);
		inputs.forEach((input) => {
			const messages = errors[input.name];
			if (messages) {
				const msgList = messages.map((msg) =>
											 this.convertAndRemove(input.name, msg)
											);
				this.showErrorsForInput(input, msgList);
			} else {
				this.resetFormGroup(this.closestParent(input, "form-group"));
			}
		});
	}

	showErrorsForInput(input, errors) {
		const formGroup = this.closestParent(input, "form-group");
		if (!formGroup) return;

		// Tìm hoặc tạo thẻ .messages
		let messages = formGroup.querySelector(".messages");
		if (!messages) {
			messages = document.createElement("div");
			messages.classList.add("messages");
			formGroup.appendChild(messages);
		}

		this.resetFormGroup(formGroup);

		if (errors.length > 0) {
			formGroup.classList.add("has-error");
			errors.forEach((error) => this.addError(messages, error));
		} else {
			formGroup.classList.add("has-success");
		}
	}

	resetFormGroup(formGroup) {
		formGroup.classList.remove("has-error", "has-success");

		const messages = formGroup.querySelector(".messages");
		if (messages) {
			messages.innerHTML = "";
		}
	}

	resetAll() {
		const groups = this.form.querySelectorAll(".form-group");
		groups.forEach((group) => this.resetFormGroup(group));
	}

	addError(messages, error) {
		const block = document.createElement("p");
		block.classList.add("help-block", "error");
		block.innerText = error;
		messages.appendChild(block);
	}

	convertAndRemove(input, text) {
		const formatted = input
		.split("-")
		.map((w) => w.charAt(0).toUpperCase() + w.slice(1))
		.join(" ");
		const regex = new RegExp(formatted, "gi");
		return text.replace(regex, "").replace(/\s+/g, " ").trim();
	}

	closestParent(element, className) {
		while (element && element !== document) {
			if (element.classList.contains(className)) return element;
			element = element.parentNode;
		}
		return null;
	}

	handleSuccess() {
		console.log("Form validated successfully!");
		const formData = new FormData(this.form);
		if (typeof this.onSuccess === "function") {
			this.onSuccess(formData);
		}
	}
}

// ------------------------------------------------------------
// Toast Notification System
class ToastNotification {
	constructor() {
		this.container = document.getElementById("toastContainer");
		this.toasts = new Map(); // Track active toasts
	}

	// Create toast HTML structure
	createToast(type, title, message, duration = 5000) {
		const toastId =
			  "toast_" +
			  Date.now() +
			  "_" +
			  Math.random().toString(36).substr(2, 9);

		const iconSvg =
			  type === "success"
		? '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>'
		: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>';

		const toastHTML = `
<div id="${toastId}" class="toast toast--${type}">
<div class="toast__icon">${iconSvg}</div>
<div class="toast__content">
<div class="toast__title">${title}</div>
<div class="toast__message">${message}</div>
</div>
<div class="toast__close" onclick="toastNotification.remove('${toastId}')"></div>
<div class="toast__progress"></div>
</div>
`;

		return { toastId, toastHTML };
	}

	// Show toast notification
	show(type, title, message, duration = 5000) {
		const { toastId, toastHTML } = this.createToast(
			type,
			title,
			message,
			duration
		);

		// Add toast to container
		this.container.insertAdjacentHTML("beforeend", toastHTML);
		const toastElement = document.getElementById(toastId);

		// Store toast reference
		this.toasts.set(toastId, {
			element: toastElement,
			timer: null,
			progressTimer: null,
		});

		// Trigger show animation
		requestAnimationFrame(() => {
			toastElement.classList.add("show");
		});

		// Start progress bar animation
		this.startProgressBar(toastId, duration);

		// Auto remove after duration
		const timer = setTimeout(() => {
			this.remove(toastId);
		}, duration);

		this.toasts.get(toastId).timer = timer;

		return toastId;
	}

	// Start progress bar animation
	startProgressBar(toastId, duration) {
		const toastData = this.toasts.get(toastId);
		if (!toastData) return;

		const progressBar =
			  toastData.element.querySelector(".toast__progress");
		if (!progressBar) return;

		// Reset progress bar
		progressBar.style.width = "100%";
		progressBar.style.transition = `width ${duration}ms linear`;

		// Start countdown
		requestAnimationFrame(() => {
			progressBar.style.width = "0%";
		});
	}

	// Remove toast notification
	remove(toastId) {
		const toastData = this.toasts.get(toastId);
		if (!toastData) return;

		const { element, timer, progressTimer } = toastData;

		// Clear timers
		if (timer) clearTimeout(timer);
		if (progressTimer) clearTimeout(progressTimer);

		// Add hide class for animation
		element.classList.add("hide");
		element.classList.remove("show");

		// Remove from DOM after animation
		setTimeout(() => {
			if (element && element.parentNode) {
				element.parentNode.removeChild(element);
			}
			this.toasts.delete(toastId);
		}, 300); // Match CSS transition duration
	}

	// Clear all toasts
	clear() {
		this.toasts.forEach((toastData, toastId) => {
			this.remove(toastId);
		});
	}

	// Show success toast
	success(title, message, duration) {
		return this.show("success", title, message, duration);
	}

	// Show error toast
	error(title, message, duration) {
		return this.show("error", title, message, duration);
	}
}

// Initialize toast notification system
const toastNotification = new ToastNotification();

// Make toastNotification globally available
window.toastNotification = toastNotification;