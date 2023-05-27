   @if($WebmasterSection->date_status)
                            <div class="form-group row">
                                <label for="date"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.topicDate') !!}
                                </label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                            {!! Form::text('date',$Topics->date, array('placeholder' => '','class' => 'form-control','id'=>'date','required'=>'')) !!}
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @else
                            {!! Form::hidden('date',$Topics->date, array('placeholder' => '','class' => 'form-control','id'=>'date')) !!}
                        @endif


                        @if($WebmasterSection->expire_date_status)
                            <div class="form-group row">
                                <label for="date"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.expireDate') !!}
                                </label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                                      format: 'YYYY-MM-DD',
                                      icons: {
                                        time: 'fa fa-clock-o',
                                        date: 'fa fa-calendar',
                                        up: 'fa fa-chevron-up',
                                        down: 'fa fa-chevron-down',
                                        previous: 'fa fa-chevron-left',
                                        next: 'fa fa-chevron-right',
                                        today: 'fa fa-screenshot',
                                        clear: 'fa fa-trash',
                                        close: 'fa fa-remove'
                                      }
                                    }">
                                            {!! Form::text('expire_date',$Topics->expire_date, array('placeholder' => '','class' => 'form-control','id'=>'expire_date')) !!}
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif