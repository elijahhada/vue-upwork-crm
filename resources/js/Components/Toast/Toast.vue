<template>
    <transition :name="transitionName">
        <div class="toast" :class="toastClasses" v-if="show">
            <div class="toast-icon">
                <component :is="toastIcon"></component>
            </div>
            <div class="toast-content">
                <div class="toast-title">{{ toastTitle }}</div>
                <div class="toast-message">{{ message }}</div>
            </div>
            <button class="toast-button" @click="$emit('hide')">&times;</button>
        </div>
    </transition>
</template>

<script>
import IconError from './IconError';
import IconWarning from './IconWarning';
import IconSuccess from './IconSuccess';

export default {
    emits: ['hide'],
    data: () => ({
        timeout: null
    }),
    props: {
        message: {
            type: String,
            required: true
        },
        title: {
            type: String,
            default: "Success"
        },
        show: {
            type: Boolean,
            default: false
        },
        type: {
            type: String,
            default: "success",
            validator: function(value) {
                return ["success", "warning", "error"].indexOf(value) !== -1;
            }
        },
        position: {
            type: String,
            default: "bottom-right"
        }
    },
    computed: {
        toastType() {
            return `toast-${this.getType}`;
        },
        toastIcon() {
            return `icon-${this.getType}`;
        },
        getType() {
            return ["success", "warning", "error"].indexOf(this.type) === -1 ? "success" : this.type;
        },
        toastTitle() {
            return this.title
                ? this.title
                : this.type.charAt(0).toUpperCase() + this.type.slice(1);
        },
        getPosition() {
            return ["bottom-left", "bottom-right", "top-left", "top-right"].indexOf(this.position) === -1 ? "bottom-right" : this.position;
        },
        toastClasses() {
            return [this.toastType, this.getPosition];
        },
        transitionName() {
            const transitions = {
                "top-left": "ltr",
                "bottom-left": "ltr",
                "top-right": "rtl",
                "bottom-right": "rtl",
            }
            return transitions[this.getPosition];
        }
    },
    components: {
        IconError,
        IconWarning,
        IconSuccess
    }
}
</script>

<style scoped>
.toast {
    width: 300px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    box-shadow: 1px 5px 10px -5px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 31;
}

.toast::before {
    content: "";
    width: 4px;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.toast-icon {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    padding: 7px;
}

.toast-success .toast-icon svg {
    fill: #ecfdf5;
    position: relative;
    top: -7px;
    left: -7px;
}

.toast-success {
    background: #ecfdf5;
}

.toast-success::before, .toast-success .toast-icon {
    background: #34d399;
}

.toast-warning .toast-icon svg {
    fill: #fffbeb;
    position: relative;
    top: -7px;
    left: -7px;
}

.toast-warning {
    background: #fffbeb;
}

.toast-warning::before, .toast-warning .toast-icon {
    background: #f59e0b;
}

.toast-error .toast-icon svg {
    fill: #fef2f2;
    position: relative;
    top: -7px;
    left: -7px;
}

.toast-error {
    background: #fef2f2;
}

.toast-error::before, .toast-error .toast-icon {
    background: #ef4444;
}

.toast-content {
    flex-grow: 1;
    margin: 0 1rem;
}

.toast-title {
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.toast-message {
    font-size: 14px;
    color: #6b7280;
}

.toast-button {
    width: 1.5em;
    height: 1.5em;
    border: none;
    padding: 0;
    color: #9ca3af;
    opacity: 0.7;
    background: transparent;
    cursor: pointer;
    font-size: 1em;
}

.toast-button:hover {
    opacity: 1;
}

.bottom-left {
    position: fixed;
    bottom: 20px;
    left: 20px;
}

.top-left {
    position: fixed;
    top: 20px;
    left: 20px;
}

.bottom-right {
    position: fixed;
    bottom: 20px;
    right: 20px;
}

.top-right {
    position: fixed;
    top: 20px;
    right: 20px;
}

.rtl-enter-active,
.rtl-leave-active {
    transition: all 0.5s ease-in-out;
}

.rtl-enter-from,
.rtl-leave-to {
    transform: translateX(100%);
}

.rtl-leave-to {
    opacity: 0;
}

.ltr-enter-active,
.ltr-leave-active {
    transition: all 0.5s ease-in-out;
}

.ltr-enter-from,
.ltr-leave-to {
    transform: translateX(-100%);
}

.ltr-leave-to {
    opacity: 0;
}
</style>
