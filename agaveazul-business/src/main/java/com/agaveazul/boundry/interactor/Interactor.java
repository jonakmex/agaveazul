package com.agaveazul.boundry.interactor;

import com.agaveazul.boundry.callback.CallBack;
import com.agaveazul.boundry.port.input.InputPort;

public interface Interactor<I extends InputPort,C extends CallBack> {
    void execute(I inputPort,C callback);
}
