<div class="modal fade" id="locationPermissionModal" tabindex="-1" aria-labelledby="locationPermissionModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="locationPermissionModalLabel">
                    <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                    {{ translate('enable_location_services') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <i class="bi bi-geo-alt display-1 text-primary"></i>
                </div>
                <h6 class="mb-3">{{ translate('find_products_near_you') }}</h6>
                <p class="text-muted mb-4">
                    {{ translate('allow_location_access_to_see_products_available_in_your_area') }}
                </p>

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

                <!-- Manual Pincode Input -->
                <div id="manual-pincode-section" class="d-none">
                    <hr class="my-4">
                    <h6 class="mb-3">{{ translate('or_enter_pincode_manually') }}</h6>
                    <form id="manual-pincode-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="manual-pincode" name="pincode"
                                   placeholder="{{ translate('enter_your_pincode') }}"
                                   pattern="[0-9]{6}" maxlength="6" required>
                            <button class="btn btn-primary" type="submit">
                                {{ translate('save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-primary px-5" id="allow-location-btn">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    {{ translate('allow_location_access') }}
                </button>
                <button type="button" class="btn btn-outline-secondary" id="skip-location-btn" data-bs-dismiss="modal">
                    {{ translate('skip_for_now') }}
                </button>
            </div>
        </div>
    </div>
</div>
