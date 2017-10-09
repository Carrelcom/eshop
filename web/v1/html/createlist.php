
                        <p>
                            Liste creation
                        </p>
                        <form method="POST" id="contact-form" class="form-horizontal" action="engine.php?action=createList" onSubmit="alert( 'Thank you for your feedback!' );">
                            <div class="form-group">
                                <input type="text" name="ListeName" id="ListName" class="form-control" placeholder="The list name" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="Name" id="Name" class="form-control" placeholder="Your Name" required/>
                            </div>
                            <div class="form-group">
                                <input type="mail" name="Mail" id="Mail" class="form-control" placeholder="Your mail" required/>
                            </div>
                            <div class="form-group">
                                <input type="date" name="Date" id="Date" class="form-control" placeholder="Available until ..." required/>
                            </div>
                            <div class="form-group">
                                <textarea name="Description" rows="20" cols="20" id="Description" class="form-control input-message"  placeholder="Any comment ?" required></textarea>
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="public[]"> Public ?
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Submit" class="btn btn-success" />
                            </div>
                        </form>
