package com.agaveazul.boundry.port.callback;

import com.agaveazul.boundry.port.output.OutputPort;

public interface CallBack<O extends OutputPort> {
    void execute(O outputPort);
}
