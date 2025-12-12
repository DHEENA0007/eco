<div class="modal fade" id="locationPermissionModal" tabindex="-1" aria-labelledby="locationPermissionModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 text-center">
                <div class="w-100">
                    <h5 class="modal-title text-center" id="locationPermissionModalLabel">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                        {{ translate('set_your_location') }}
                    </h5>
                    <p class="text-muted small mb-0">{{ translate('enter_your_pincode_to_see_products_available_in_your_area') }}</p>
                </div>
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <i class="bi bi-pin-map-fill display-4 text-primary"></i>
                </div>

                <div id="location-status" class="mb-3">
                    <div id="location-loading" class="d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted small">{{ translate('detecting_your_location') }}...</p>
                    </div>

                    <div id="location-success" class="d-none alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <span>{{ translate('location_detected_successfully') }}</span>
                        <div class="mt-2 small">
                            <strong>{{ translate('pincode') }}:</strong> <span id="detected-pincode"></span>
                        </div>
                    </div>

                    <div id="location-error" class="d-none alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <span id="location-error-message"></span>
                    </div>
                </div>

                <!-- Manual Pincode Input (Main Option) -->
                <div id="manual-pincode-section" class="mb-4">
                    <div class="card border-primary bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-primary mb-3">
                                <i class="bi bi-pencil-square me-2"></i>
                                {{ translate('enter_pincode_manually') }}
                            </h6>
                            <form id="manual-pincode-form">
                                <div class="input-group input-group-lg mb-3">
                                    <span class="input-group-text">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-lg text-center" id="manual-pincode" name="pincode"
                                           placeholder="{{ translate('enter_6_digit_pincode') }}"
                                           pattern="[0-9]{6}" maxlength="6" required>
                                    <button class="btn btn-primary btn-lg" type="submit">
                                        {{ translate('save') }}
                                    </button>
                                </div>
                                <small class="text-muted">{{ translate('e.g. 110001, 400001, 600001') }}</small>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Auto-detect option (Secondary) -->
                    <div class="mt-4">
                        <div class="divider-with-text my-3">
                            <span class="text-muted small">{{ translate('or') }}</span>
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="allow-location-btn">
                            <i class="bi bi-crosshair me-2"></i>
                            {{ translate('auto_detect_location') }}
                        </button>
                        <div class="mt-2">
                            <small class="text-muted">{{ translate('detect_location_automatically_using_gps') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pt-0">
                <button type="button" class="btn btn-link text-muted" id="skip-location-btn" data-bs-dismiss="modal">
                    {{ translate('skip_for_now') }}
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.divider-with-text {
    position: relative;
    text-align: center;
}

.divider-with-text:before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #dee2e6;
}

.divider-with-text span {
    background: white;
    padding: 0 1rem;
}
</style>
