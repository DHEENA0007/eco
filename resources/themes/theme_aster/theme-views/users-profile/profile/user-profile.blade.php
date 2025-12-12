@php
    use App\Utils\Helpers;
@endphp
@extends('theme-views.layouts.app')
@section('title', translate('my_Profile').' | '.$web_config['company_name'].' '.translate('ecommerce'))
@section('content')
    <main class="main-content d-flex flex-column gap-3 py-3 mb-4">
        <div class="container">
            <div class="row g-3">
                @include('theme-views.partials._profile-aside')
                <div class="col-lg-9">
                    <!-- Welcome Section -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="mb-0">{{ translate('Hello') }}, {{ $customer_detail->f_name }} {{ $customer_detail->l_name }}</h4>
                            <p class="text-muted mb-0">{{ translate('Welcome to your account') }}</p>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex gap-3 flex-wrap flex-grow-1">
                                <div class="card border flex-grow-1">
                                    <div class="card-body grid-center">
                                        <div class="text-center">
                                            <h3 class="mb-2">{{ $total_order }}</h3>
                                            <div class="d-flex align-items-center gap-2">
                                                <img width="16"
                                                     src="{{ theme_asset('assets/img/icons/profile-icon2.png') }}"
                                                     class="dark-support" alt="">
                                                <span>{{translate('Orders')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border flex-grow-1">
                                    <div class="card-body grid-center">
                                        <div class="text-center">
                                            <h3 class="mb-2">{{ $wishlists }}</h3>
                                            <div class="d-flex align-items-center gap-2">
                                                <img width="16"
                                                     src="{{ theme_asset('assets/img/icons/profile-icon3.png') }}"
                                                     class="dark-support" alt="">
                                                <span>{{translate('wishlist')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border flex-grow-1">
                                    <div class="card-body grid-center">
                                        <div class="text-center">
                                            <h3 class="mb-2">{{ webCurrencyConverter($totalWalletBalance ?? 0) }}</h3>
                                            <div class="d-flex align-items-center gap-2">
                                                <img width="16"
                                                     src="{{theme_asset('assets/img/icons/profile-icon5.png')}}"
                                                     class="dark-support" alt="">
                                                <span>{{translate('wallet')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border flex-grow-1">
                                    <div class="card-body grid-center">
                                        <div class="text-center">
                                            <h3 class="mb-2">{{$total_loyalty_point}}</h3>
                                            <div class="d-flex align-items-center gap-2">
                                                <img width="16"
                                                     src="{{theme_asset('assets/img/icons/profile-icon6.png')}}"
                                                     class="dark-support" alt="">
                                                <span class="text-capitalize">{{translate('loyalty_point')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="mb-3">{{ translate('Your Account') }}</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-4">
                                    <a href="{{route('account-oder')}}" class="card border h-100 text-decoration-none">
                                        <div class="card-body text-center">
                                            <img width="40" src="{{ theme_asset('assets/img/icons/profile-icon2.png') }}" class="mb-2" alt="">
                                            <h6>{{ translate('Your Orders') }}</h6>
                                            <p class="text-muted small">{{ translate('Track, return, or buy things again') }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <a href="{{route('user-account')}}" class="card border h-100 text-decoration-none">
                                        <div class="card-body text-center">
                                            <img width="40" src="{{ theme_asset('assets/img/icons/profile-icon.png') }}" class="mb-2" alt="">
                                            <h6>{{ translate('Login & Security') }}</h6>
                                            <p class="text-muted small">{{ translate('Edit login, name, and mobile number') }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <a href="{{route('account-address-add')}}" class="card border h-100 text-decoration-none">
                                        <div class="card-body text-center">
                                            <img width="40" src="{{ theme_asset('assets/img/icons/location.png') }}" class="mb-2" alt="">
                                            <h6>{{ translate('Your Addresses') }}</h6>
                                            <p class="text-muted small">{{ translate('Edit addresses for orders and gifts') }}</p>
                                        </div>
                                    </a>
                                </div>
                                @if ($web_config['wallet_status'] == 1)
                                <div class="col-md-6 col-lg-4">
                                    <a href="{{route('wallet')}}" class="card border h-100 text-decoration-none">
                                        <div class="card-body text-center">
                                            <img width="40" src="{{ theme_asset('assets/img/icons/profile-icon5.png') }}" class="mb-2" alt="">
                                            <h6>{{ translate('Your Wallet') }}</h6>
                                            <p class="text-muted small">{{ translate('Manage your wallet balance') }}</p>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                <div class="col-md-6 col-lg-4">
                                    <a href="{{route('wishlists')}}" class="card border h-100 text-decoration-none">
                                        <div class="card-body text-center">
                                            <img width="40" src="{{ theme_asset('assets/img/icons/profile-icon3.png') }}" class="mb-2" alt="">
                                            <h6>{{ translate('Your Wishlist') }}</h6>
                                            <p class="text-muted small">{{ translate('View and manage your wishlist') }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <a href="{{route('account-tickets')}}" class="card border h-100 text-decoration-none">
                                        <div class="card-body text-center">
                                            <img width="40" src="{{ theme_asset('assets/img/icons/profile-icon8.png') }}" class="mb-2" alt="">
                                            <h6>{{ translate('Support Tickets') }}</h6>
                                            <p class="text-muted small">{{ translate('Get help and contact support') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Details Section -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap justify-content-between gap-3">
                                <h5>{{translate('Personal_Details')}}</h5>
                                <a href="{{route('user-account')}}"
                                   class="btn btn-outline-secondary rounded-pill px-3 px-sm-4"><span
                                        class="d-none d-sm-inline-block text-capitalize">{{ translate('edit_profile') }}</span> <i
                                        class="bi bi-pencil-square"></i></a>
                            </div>

                            <div class="mt-4">
                                <div class="row text-dark">
                                    <div class="col-md-6 col-xl-6 col-lg-6">
                                        <dl class="mb-0 flexible-grid width--7rem">
                                            <dt class="pe-1 text-capitalize">{{translate('first_name')}}</dt>
                                            <dd>{{$customer_detail['f_name']}}</dd>

                                            <dt class="pe-1 text-capitalize">{{translate('last_name')}}</dt>
                                            <dd>{{$customer_detail['l_name']}}</dd>

                                            <dt class="pe-1 text-capitalize">{{translate('pincode')}}</dt>
                                            <dd class="d-flex align-items-center gap-2">
                                                <span id="user-pincode">{{$customer_detail['pincode'] ?? translate('not_set')}}</span>
                                                @if($customer_detail['pincode'])
                                                    <button class="btn btn-sm btn-outline-secondary p-1" onclick="editPincode()" title="{{translate('edit_pincode')}}">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-primary px-2 py-1" onclick="editPincode()" title="{{translate('add_pincode')}}">
                                                        <i class="bi bi-plus me-1"></i>{{translate('add')}}
                                                    </button>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6 col-xl-6 col-lg-6">
                                        <dl class="mb-0 flexible-grid width--7rem">
                                            <dt class="pe-1">{{translate('phone')}}</dt>
                                            <dd class="d-flex align-items-center gap-1">
                                                <a href="tel:{{$customer_detail['phone']}}"
                                                   class="text-dark">{{$customer_detail['phone']}}</a>

                                                @if($customer_detail['phone'] && getLoginConfig(key: 'phone_verification'))
                                                    @if($customer_detail['is_phone_verified'])
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ translate('Your_phone_is_verified.') }}">
                                                        <img width="16"
                                                             src="{{theme_asset('assets/img/icons/verified.svg')}}"
                                                             class="dark-support" alt="">
                                                    </span>
                                                        @else
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ translate('Phone_not_verified.') }} {{ translate('Please_verify_through_the_user_app.') }}">
                                                        <img width="16"
                                                             src="{{theme_asset('assets/img/icons/verified-error.svg')}}"
                                                             class="dark-support" alt="">
                                                    </span>
                                                    @endif
                                                @endif
                                            </dd>

                                            <dt class="pe-1">{{translate('email')}}</dt>
                                            <dd class="d-flex align-items-center gap-1">
                                                <a href="mailto:{{$customer_detail['email']}}"
                                                   class="text-dark">{{$customer_detail['email']}}</a>

                                                @if($customer_detail['email'] && getLoginConfig(key: 'email_verification'))
                                                    @if($customer_detail['is_email_verified'])
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ translate('Your_email_is_verified.') }}">
                                                        <img width="16"
                                                             src="{{theme_asset('assets/img/icons/verified.svg')}}"
                                                             class="dark-support" alt="">
                                                    </span>
                                                        @else
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ translate('Email_not_verified.') }} {{ translate('Please_verify_through_the_user_app.') }}">
                                                        <img width="16"
                                                             src="{{theme_asset('assets/img/icons/verified-error.svg')}}"
                                                             class="dark-support" alt="">
                                                    </span>
                                                    @endif
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Addresses Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <h5 class="text-capitalize">{{translate('my_addresses')}}</h5>
                                <a href="{{route('account-address-add')}}"
                                   class="btn btn-outline-secondary rounded-pill px-3 px-sm-4">
                                    <span class="d-none d-sm-inline-block text-capitalize">{{translate('add_address')}}</span>
                                        <i class="bi bi-geo-alt-fill"></i>
                                </a>
                            </div>
                            <div class="mt-3">
                                <div class="row gy-3 text-dark">
                                    @foreach($addresses as $address)
                                        <div class="col-md-6">
                                            <div class="card border-0">
                                                <div
                                                    class="card-header gap-2 align-items-center d-flex justify-content-between">
                                                    <h6>{{translate($address['address_type'])}}
                                                        ({{ $address['is_billing'] == 1 ? translate('billing_address'):translate('shipping_address')}})</h6>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <a href="{{route('address-edit',$address->id)}}" class="p-0 bg-transparent border-0">
                                                            <img src="{{theme_asset('assets/img/svg/location-edit.svg')}}"
                                                                alt="" class="svg">
                                                        </a>

                                                        <a href="javascript:"
                                                           data-action="{{route('address-delete',['id'=>$address->id])}}"
                                                           data-message="{{translate('want_to_delete_this_address').'?'}}"
                                                           class="p-0 bg-transparent border-0 delete-action">
                                                            <img src="{{theme_asset('assets/img/svg/delete.svg')}}"
                                                                 alt="" class="svg">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        <dl class="mb-0 flexible-grid width--5rem">
                                                            <dt>{{translate('name')}}</dt>
                                                            <dd>{{$address['contact_person_name']}}</dd>

                                                            <dt>{{translate('phone')}}</dt>
                                                            <dd><a href="javascript:" class="text-dark">{{$address['phone']}}</a>
                                                            </dd>
                                                            <dt>{{translate('address')}}</dt>
                                                            <dd>{{$address['address']}}</dd>
                                                        </dl>
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if(count($addresses) == 0)
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-5 w-100">
                                            <img width="60" class="mb-3" src="{{ theme_asset('assets/img/empty-state/empty-address.svg') }}" alt="">
                                            <h5 class="text-center text-muted">
                                                {{ translate('No_address_found') }}!
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Pincode Modal -->
    <div class="modal fade" id="editPincodeModal" tabindex="-1" aria-labelledby="editPincodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPincodeModalLabel">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                        {{translate('update_pincode')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPincodeForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editPincode" class="form-label">{{translate('enter_new_pincode')}}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg" id="editPincode" name="pincode"
                                       placeholder="{{translate('enter_6_digit_pincode')}}"
                                       pattern="[0-9]{6}" maxlength="6" required>
                            </div>
                            <div class="form-text">{{translate('e.g. 110001, 400001, 600001')}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translate('cancel')}}</button>
                        <button type="submit" class="btn btn-primary">{{translate('update_pincode')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        'use strict';
        
        function editPincode() {
            const currentPincode = document.getElementById('user-pincode').textContent.trim();
            const input = document.getElementById('editPincode');
            
            // Pre-fill current pincode if it exists and is not "not_set"
            if (currentPincode && currentPincode !== '{{translate('not_set')}}') {
                input.value = currentPincode;
            }
            
            const modal = new bootstrap.Modal(document.getElementById('editPincodeModal'));
            modal.show();
            
            // Focus on input after modal is shown
            setTimeout(() => {
                input.focus();
                input.select();
            }, 300);
        }
        
        // Handle pincode form submission
        document.getElementById('editPincodeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const pincode = document.getElementById('editPincode').value.trim();
            
            if (!/^\d{6}$/.test(pincode)) {
                toastr.error('{{translate('please_enter_valid_6_digit_pincode')}}');
                return;
            }
            
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>{{translate('updating')}}...';
            
            fetch('/customer/save-location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ pincode: pincode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('user-pincode').textContent = pincode;
                    toastr.success('{{translate('pincode_updated_successfully')}}');
                    bootstrap.Modal.getInstance(document.getElementById('editPincodeModal')).hide();
                    
                    // Update button visibility
                    const pincodeContainer = document.getElementById('user-pincode').parentElement;
                    const existingBtn = pincodeContainer.querySelector('button');
                    
                    if (existingBtn && existingBtn.textContent.includes('{{translate('add')}}')) {
                        // Replace "Add" button with "Edit" button
                        existingBtn.outerHTML = `
                            <button class="btn btn-sm btn-outline-secondary p-1" onclick="editPincode()" title="{{translate('edit_pincode')}}">
                                <i class="bi bi-pencil"></i>
                            </button>`;
                    }
                    
                    // Store in localStorage for location service
                    localStorage.setItem('user_pincode', pincode);
                    
                } else {
                    toastr.error(data.message || '{{translate('failed_to_update_pincode')}}');
                }
            })
            .catch(error => {
                toastr.error('{{translate('something_went_wrong')}}');
                console.error('Error:', error);
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        });
    </script>
