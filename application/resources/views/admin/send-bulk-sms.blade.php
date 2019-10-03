@extends('admin')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Send Bulk SMS')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Send Bulk SMS')}}</h3>
                        </div>
                        <div class="panel-body">
                            <form class="" role="form" method="post" action="{{url('sms/post-bulk-sms')}}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>{{language_data('Client Group')}}</label>
                                    <select class="selectpicker form-control" name="client_group"  data-live-search="true">
                                        @foreach($client_group as $cg)
                                            <option value="{{$cg->id}}">{{$cg->group_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('SMS Gateway')}}</label>
                                    <select class="selectpicker form-control" name="sms_gateway"  data-live-search="true">
                                        @foreach($gateways as $sg)
                                            <option value="{{$sg->id}}">{{$sg->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('SMS Templates')}}</label>
                                    <select class="selectpicker form-control" name="sms_template"  data-live-search="true" id="sms_template">
                                        <option>{{language_data('Select Template')}}</option>
                                        @foreach($sms_templates as $st)
                                            <option value="{{$st->id}}">{{$st->template_name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Sender ID')}}</label>
                                    <select class="selectpicker form-control" name="sender_id"  data-live-search="true">
                                        @foreach($sender_id as $sg)
                                            <option value="{{$sg->sender_id}}">{{$sg->sender_id}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Message')}}</label>
                                    <textarea class="form-control" name="message" rows="5" id="message"></textarea>
                                    <span class="help text-uppercase" id="remaining">160 {{language_data('characters remaining')}}</span>
                                    <span class="help text-success" id="messages">1 {{language_data('message')}}(s)</span>
                                </div>
                                <span class="text-uppercase text-complete help">{{language_data('After click on Send button, do not refresh your browser')}}</span>
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-send"></i> {{language_data('Send')}} </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}

    <script>
        $(document).ready(function(){

            var $get_msg=$("#message");
            var $remaining = $('#remaining'),
                $messages = $remaining.next();

            $("#sms_template").change(function () {
                var id = $(this).val();
                var _url = $("#_url").val();
                var dataString = 'st_id=' + id;
                $.ajax
                ({
                    type: "POST",
                    url: _url + '/sms/get-template-info',
                    data: dataString,
                    cache: false,
                    success: function ( data ) {
                        $("#sender_id").val(data.from);
                        $get_msg.val(data.message);

                        var chars = $get_msg.val(data.message).val().length,
                            messages = Math.ceil(chars / 160),
                            remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

                        $remaining.text(remaining + ' characters remaining');
                        $messages.text(messages + ' message(s)');
                    }
                });
            });

            $get_msg.keyup(function(){
                var chars = this.value.length,
                    messages = Math.ceil(chars / 160),
                    remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

                $remaining.text(remaining + ' characters remaining');
                $messages.text(messages + ' message(s)');
            });

        });
    </script>
@endsection