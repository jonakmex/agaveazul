package com.agaveazul.gateway;

public interface Gateway<K,O> {
    O save(O object);
    O findById(K id);
    void delete(K id);
}
