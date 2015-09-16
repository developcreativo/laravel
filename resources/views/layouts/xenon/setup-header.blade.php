<div class="settings-pane"><a href="#" data-toggle="settings-pane" data-animate="true">
        ×
    </a>

    <div class="settings-pane-inner">
        <div class="row">
            <div class="col-md-4">
                <div class="user-info">
                    <div class="user-image">{!! HTML::image('img/'.Auth::user()->img,'usuario',['class'=>'img-responsive img-circle']) !!}
                                   </div>
                    <div class="user-details"><h3><a href="http://themes.laborator.co/xenon/extra/profile/">{{str_limit(Auth::user()->name,$limit = 19, $end = '')}}</a> <span class="user-status is-online"></span></h3>

                        <p class="user-title">{{ Auth::user()->role }}</p>

                        <div class="user-links"><a href="http://themes.laborator.co/xenon/extra/profile/"
                                                   class="btn btn-primary">Edit Profile</a> <a
                                    href="http://themes.laborator.co/xenon/extra/profile/" class="btn btn-success">Upgrade</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 link-blocks-env">
                <div class="links-block left-sep"><h4><span>Notifications</span></h4>
                    <ul class="list-unstyled">
                        <li>
                            <div class="cbr-replaced cbr-checked cbr-primary">
                                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done" checked="checked"
                                                              id="sp-chk1"></div>
                                <div class="cbr-state"><span></span></div>
                            </div>
                            <label for="sp-chk1">Messages</label></li>
                        <li>
                            <div class="cbr-replaced cbr-checked cbr-primary">
                                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done" checked="checked"
                                                              id="sp-chk2"></div>
                                <div class="cbr-state"><span></span></div>
                            </div>
                            <label for="sp-chk2">Events</label></li>
                        <li>
                            <div class="cbr-replaced cbr-checked cbr-primary">
                                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done" checked="checked"
                                                              id="sp-chk3"></div>
                                <div class="cbr-state"><span></span></div>
                            </div>
                            <label for="sp-chk3">Updates</label></li>
                        <li>
                            <div class="cbr-replaced cbr-checked cbr-primary">
                                <div class="cbr-input"><input type="checkbox" class="cbr cbr-done" checked="checked"
                                                              id="sp-chk4"></div>
                                <div class="cbr-state"><span></span></div>
                            </div>
                            <label for="sp-chk4">Server Uptime</label></li>
                    </ul>
                </div>
                <div class="links-block left-sep"><h4><a href="#"> <span>Help Desk</span> </a></h4>
                    <ul class="list-unstyled">
                        <li><a href="#"> <i class="fa-angle-right"></i>
                                Support Center
                            </a></li>
                        <li><a href="#"> <i class="fa-angle-right"></i>
                                Submit a Ticket
                            </a></li>
                        <li><a href="#"> <i class="fa-angle-right"></i>
                                Domains Protocol
                            </a></li>
                        <li><a href="#"> <i class="fa-angle-right"></i>
                                Terms of Service
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>